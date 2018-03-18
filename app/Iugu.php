<?php
namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use App\Parameter;

class Iugu extends Model
{
    /**
     * Issue Ticket IUGU
     *
     */
    public static function issueTicket(Debt $debt)
    {
        try 
        {
            if ($debt) 
            {
                $idCustomer = Parameter::CLIENTE_ID_IUGU;
                
                $token = $this->createToken($idCustomer);
                
                $paymentMethod = $this->createPaymentMethod($idCustomer);
                
                $items = $this->getItems($debt->pgm_pagador_nome, 1, $debt->pgm_valor);
                
                if($paymentMethod && $items){
                    $result = $this->directBilling($debts, 'bank_slip', $token, $paymentMethod['id'], true, $idCustomer, '', $debt->pgm_pagador_email, $debt->pgm_parcelas, null, 5, $items);
                }
                
                return $result;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Issue Card IUGU
     *
     */
    public static function issueCard(Debt $debt)
    {
        try 
        {
            if ($debt) 
            {
                $idCustomer = Parameter::CLIENTE_ID_IUGU;
                
                $token = $this->createToken($idCustomer);
                
                $formaDePamanto = $this->createPaymentMethod($idCustomer);
                
                $returnUrl = 'http://smartclic.com.br/';
                
                $expiredUrl = 'http://smartclic.com.br/';
                
                $emails = $debt->pgm_pagador_email.',smart@smartclic.com.br';
                
                $fatura = $this->createInvoice($debt->pgm_pagador_email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, false, '', '', $idCustomer, false, null, 'credit_card');
                
                $items = $this->getItems($debt->pgm_pagador_razao, 1, $debt->pgm_valor);
                
                if($formaDePamanto && $items){
                    $result = self::cobrancaDireta($debts, '', $token, $formaDePamanto['id'], true, $idCustomer, $fatura['id'], $debt->pgm_pagador_email, $debt->pgm_parcelas, null, 5, $items);
                }
                
                return $result;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }
    
    
    
    /**
     * Create Invoice IUGU
     *
     * Create an Invoice for a Customer (Can be a client object or just an email).
     */
    public static function createInvoice($email, $emails, $dueDate, $items, $returnUrl, $expiredUrl, $fines, $latePaymentFine, $perDayInterest = true, $discountCents, $idCustomer, $ignoreEmail = false, $idSubscription = null, $payableWith = 'all', $credits = null, $earlyPaymentDiscount = false, $payer, $logs = null, $paymenDiscounts = null, $custonVariables = null)
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->post('https://api.iugu.com/v1/invoices', [
                'form_params' => [
                    'email' => $email,
                    'cc_emails' => $emails,
                    'due_date' => ($dueDate) ? $dueDate : date('Y-m-d') + 3,
                    'ensure_workday_due_date' => true,
                    $items, // Required - Invoice items. "price cents" minimum value 100
                    'return_url' => $returnUrl,
                    'expired_url' => $expiredUrl,
                    'fines' => $fines, // Boolean to Enable or Disable Late Payment Penalty
                    'late_payment_fine' => $latePaymentFine,
                    'per_day_interest' => $perDayInterest,
                    'discount_cents' => $discountCents,
                    'customer_id' => $idCustomer,
                    'ignore_due_email' => $ignoreEmail,
                    'subscription_id' => $idSubscription,
                    'payable_with' => $payableWith,
                    'credits' => $credits,
                    'early_payment_discount' => $earlyPaymentDiscount,
                    'payer' => $payer,
                    $logs,
                    $paymenDiscounts,
                    $custonVariables
                
                ]
            ]);
            
            return $request;
            
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Capture Invoice IUGU
     *
     * Captures an invoice with status "In Analysis" / "in analysis".
     */
    public static function captureInvoice($idInvoice)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice . '/capture', [
                    'form_params' => [
                        'id' => $idInvoice
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Refund Invoice IUGU
     *
     * Refund an Invoice. Only some means of payment allow the refund, as for example the Credit Card. 
     * After the refund, the invoice has the status of "refunded" / "refunded".
     * 
     */
    public static function refundInvoice($idInvoice)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice . '/refund', [
                    'form_params' => [
                        'id' => $idInvoice
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Cancel Invoice IUGU
     *
     * Cancel a invoice
     */
    public static function cancelInvoice($idInvoice)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice . '/cancel', [
                    'form_params' => [
                        'id' => $idInvoice
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Generate second invoice path IUGU
     *
     * Generates the second copy of an invoice with the status "pending". The current invoice is canceled and a new one is created with the same status.
     */
    public static function gerarateSecondInvoicePath($idInvoice, $items = null)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice . '/duplicate', [
                    'form_params' => [
                        'id' => $idInvoice,
                        'due_date' => date('YY-M-D'),
                        'ignore_due_email' => false,
                        'ignore_canceled_email' => true,
                        'current_fines_option' => true,
                        'keep_early_payment_discount' => false,
                        $items
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Invoice IUGU
     *
     * Returns the data of an Invoice.
     */
    public static function searchInvoice($idInvoice)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice, [
                    'form_params' => [
                        'id' => $idInvoice
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Invoices IUGU
     *
     * Returns a list of invoices in your account sorted by the creation date, from the most recent to the latest. 
     * By default, this endpoint returns a maximum of 100 records. The "totalItems" field always contains the total 
     * number of invoices registered, regardless of the search Parameter used, and the search result is always within "items".
     * 
     */
    public static function listInvoices()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/invoices/');
            
            return $request;
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Send by email IUGU
     *
     * Send the iugu invoice to the email linked to it.
     */
    public static function sendEmailInvoice($idInvoice)
    {
        try 
        {
            if ($idInvoice) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idInvoice . 'send_email', [
                    'form_params' => [
                        'id' => $idInvoice
                    ]
                ]);
                
                return $request;
            }
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Direct Collection IUGU
     *
     * Simple collection via ticket or credit card.
     */
    public static function directBilling(Debt $debt, $method = 'bank_slip', $token = null, $customerPaymentMethodId = null, $restrictPaymentMethod = true, $idCustomere = null, $idFatura = null, $email = null, $months, $discountCents = null, $bankSlipExtraDays = 3, $items = null)
    {
        try 
        {
            
            if ($debt) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/charge', [
                    'form_params' => [
                        'method' => $method,
                        'token' => $token,
                        'customer_payment_method_id' => $customerPaymentMethodId,
                        'restrict_payment_method' => $restrictPaymentMethod, // If true, it restricts the billing method of payment to that defined in method.
                        'customer_id' => $idCustomer,
                        'invoice_id' => $idInvoice,
                        'email' => $email, // Customer email (not filled in if an "invoice_id" is sent)
                        'months' => $months,
                        'discount_cents' => $discountCents,
                        'bank_slip_extra_days' => $bankSlipExtraDays,
                        'keep_dunning' => true,
                        'payer' => self::getPayer($debt),
                        $items
                    ]
                ]);
            }
            
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create Client IUGU
     *
     * Create a client object
     */
    public static function createCustomer(Debt $debt, $customVariables = null)
    {
        try {
            if ($debt) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/customers', [
                    'form_params' => [
                        'email' => $debt->pgm_pagador_email,
                        'name' => $debt->pgm_pagador_nome,
                        'phone' => substr($debt->pgm_pagador_celular, 2),
                        'phone_prefix' => substr($debt->pgm_pagador_celular, 0, 2),
                        'cpf_cnpj' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                        'cc_emails' => $debt->pgm_pagador_email,
                        'zip_code' => $debt->pgm_endereco_cep,
                        'number' => $debt->pgm_endereco_numero,
                        'street' => $debt->pgm_endereco_logradouro,
                        'city' => $debt->pgm_endereco_cidade,
                        'state' => $debt->pgm_endereco_estado,
                        'district' => $debt->pgm_endereco_bairro,
                        'complement' => $debt->pgm_endereco_complemento,
                        $customVariables
                    ]
                ]);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update Client IUGU
     *
     * Update the data of a Customer. Any Parameter not entered will not be changed.
     */
    public static function updateClient(Debt $debt, $defaultPaymentMethodId = null, $customVariables = null)
    {
        try 
        {
            if ($debt) 
            {
                $client = new Client(self::getHeaders());
                
                $request = $client->put('https://api.iugu.com/v1/customers/' . Parameter::CLIENTE_ID_IUGU, [
                    'form_params' => [
                        'email' => $debt->pgm_pagador_email,
                        'name' => $debt->pgm_pagador_nome,
                        'notes' => $debt->pgm_intermediario_status,
                        "phone" => substr($debt->pgm_pagador_celular, 2),
                        "phone_prefix" => substr($debt->pgm_pagador_celular, 0, 2),
                        'cpf_cnpj' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                        'cc_emails' => $debt->pgm_pagador_email,
                        'zip_code' => $debt->pgm_endereco_cep,
                        'number' => $debt->pgm_endereco_numero,
                        'street' => $debt->pgm_endereco_logradouro,
                        'city' => $debt->pgm_endereco_cidade,
                        'state' => $debt->pgm_endereco_estado,
                        'district' => $debt->pgm_endereco_bairro,
                        'complement' => $debt->pgm_endereco_complemento,
                        'default_payment_method_id' => $defaultPaymentMethodId,
                        $customVariables
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove Client IUGU
     *
     * Permanently remove a client. However, it does not allow you to remove clients with linked signatures or invoices.
     */
    public static function removeClient($idCustomer)
    {
        try 
        {
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delte('https://api.iugu.com/v1/customers/' . $idCustomer);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Client IUGU
     *
     * Returns the data of a client
     */
    public static function searchCliente($idCustomer)
    {
        try 
        {
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Clients IUGU
     * 
     * Returns a list of all customers registered to your account sorted by Creation date, the first being the most recently created. 
     * The "totalItems" field always contains the number of customers registered, regardless of the search Parameter 
     * used and the search result is always within "items".
     * 
     */
    public static function listClients()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/customers/');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create Payment Method IUGU
     *
     * Creates a Customer Payment Form.
     */
    public static function createPaymentMethod($idCustomer, $token)
    {
        try 
        {
            
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods', [
                    'form_params' => [
                        'description' => 'SmartClic',
                        'token' => $token,
                        'set_as_default' => false
                    ]
                ]);
                
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Payment Method IUGU
     *
     * Creates a Customer Payment Form.
     */
    public static function changePaymentMethod($idCustomer, $idPayment)
    {
        try 
        {
            if ($idCustomer && $idPayment) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment, [
                    'form_params' => [
                        'description' => 'SmartClic'
                    ]
                ]);
                
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove Payment Method IUGU
     *
     * Permanently removes a form of payment from a customer.
     */
    public static function removeFormPayment($idCustomer, $idPayment)
    {
        try 
        {
            if ($idCustomer && $idPayment) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment, [
                    'form_params' => [
                        'description' => 'SmartClic'
                    ]
                ]);
                
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Form of Payment IUGU
     *
     * Returns the data of a Customer Payment Form
     */
    public static function searchFormPayment($idCustomer, $idPayment)
    {
        try 
        {
            if ($idCustomer && $idPayment) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List of Forms of Payment IUGU
     *
     * Returns a list of all forms of payment for a given customer
     * 
     */
    public static function listFormPayment($idCustomer)
    {
        try 
        {
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods');
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create Plan IUGU
     *
     * Create a plan
     */
    public static function createPlan($name, $identifier, $interval, $intervalType = 'months', $valueCents, $payableWith = 'bank_slip', $features = null)
    {
        try 
        {
            if ($identifier) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/plans', [
                    'form_params' => [
                        'name' => $name,
                        'identifier' => $identifier,
                        'interval' => $interval, // Plan cycle (Integer greater than 0)
                        'interval_type' => $intervalType, // Type of interval ("weeks" or "months")
                        'value_cents' => $valueCents,
                        'payable_with' => $payableWith,
                        $features
                    ]
                ]);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Plan IUGU
     *
     * Changes the data of a Plan, is not informed by anything. 
     * The changes will not change the Subscriptions that already use the Plan, but only the new ones.
     * 
     */
    public static function changePlan($idPlan, $name, $interval, $intervalType = 'months', $valueCents, $payableWith = 'bank_slip', $features = null)
    {
        try 
        {
            if ($idPlan) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/plans/' . $idPlan, [
                    'form_params' => [
                        'name' => $name,
                        'interval' => $interval, // Plan cycle (Integer greater than 0)
                        'interval_type' => $intervalType, // Type of interval ("weeks" or "months")
                        'value_cents' => $valueCents,
                        'payable_with' => $payableWith,
                        $features
                    ]
                ]);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove Plan IUGU
     *
     * Removes data from a Plan
     * 
     */
    public static function removePlan($idPlan)
    {
        try 
        {
            if ($idPlan) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/plans/' . $idPlan);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Plan IUGU
     *
     * Returns the data of a Plane
     */
    public static function searchPlan($idPlan)
    {
        try 
        {
            if ($idPlan) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/plans/' . $idPlan);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search for plan by Identifier IUGU
     *
     * Returns the data in a plan using an identifier.
     */
    public static function searcForPlansByIdentifier($identifier)
    {
        try 
        {
            if ($identifier) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/plans/identifier/' . $identifier);
                return json_decode($request->getBody()->getContents());
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Plans IUGU
     *
     * Returns a list of all plans in your account sorted by Creation date, the first being the most recently created. 
     * The totalItems field always contains the number of plans registered, regardless of the search Parameter used 
     * and the search result is always within items.
     * 
     */
    public static function listPlans()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/plans');
            return json_decode($request->getBody()->getContents());
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create Subscription IUGU
     *
     * Create a subscription
     */
    public static function createSubscription($idCustomer, $planIdentifier = '', $expiresAt, $payablWith = 'bank_slip', $creditsBased = false, $priceCents, $creditsCycle, $creditsMin, $subitems = null, $customerVariables = null)
    {
        try 
        {
            
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions', [
                    'form_params' => [
                        'plan_identifier' => $planIdentifier, // Identifier of the Plan. Only sent to signatures that are not credits_based
                        'customer_id' => $idCustomer,
                        'expires_at' => ($expiresAt) ? $expiresAt : date('d/m/Y') + 3,
                        'only_on_charge_success' => true,
                        'ignore_due_email' => false,
                        'payable_with' => $payablWith,
                        'credits_based' => $creditsBased, // Is it a subscription based on credits? boolean
                        'price_cents' => $priceCents, // Recharge cents price for credit-based signatures
                        'credits_cycle' => $creditsCycle, // Number of credits added to each cycle, only sent to credits_based signatures
                        'credits_min' => $creditsMin, // Amount of credits that activates the cycle, for example: Make a charge every time the subscription has only 1 credit remaining. This first credit is credits_min
                        $subitems,
                        $customerVariables
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Enable Subscription IUGU
     *
     * Activates a Signature. An Invoice can be generated for the customer
     */
    public static function enableSignature($idSubscription)
    {
        try 
        {
            
            if ($idSubscription) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $idSubscription . '/activate');
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Suspend Subscription IUGU
     *
     * Suspends a Subscription
     */
    public static function suspendSubscription($idSubscription)
    {
        try 
        {
            if ($idSubscription) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $idSubscription . '/suspend');
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Subscription IUGU
     *
     * Change the data of a Signature, any Parameter not informed will not be changed
     */
    public static function changeSubscription($idSubscription, $planIdentifier, $expiresAt, $ignoreDueEmail, $payableWith, $creditsBased, $priceCents, $creditsCycle, $creditsMin, $suspended = false, $skipCharge = true, $subitems = null)
    {
        try {
            
            if ($idSubscription && $planIdentifier) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idSubscription, [
                    'form_params' => [
                        'plan_identifier' => $planIdentifier, // Identifier of the Plan. Only sent to signatures that are not credits_based
                        'expires_at' => ($expiresAt) ? $expiresAt : date('d/m/Y') + 3,
                        'ignore_due_email' => $ignoreDueEmail,
                        'payable_with' => $payableWith,
                        'credits_based' => $creditsBased, // Is it a subscription based on credits? boolean
                        'price_cents' => $priceCents, // Recharge cents price for credit-based signatures
                        'credits_cycle' => $creditsCycle, // Number of credits added to each cycle, only sent to credits_based signatures
                        'credits_min' => $creditsMin, // Amount of credits that activates the cycle, for example: Make a charge every time the subscription has only 1 credit remaining. This first credit is credits_min
                        'suspended' => $suspended, // Suspended subscription? boolean
                        'skip_charge' => $skipCharge, // Ignore Billing? boolean
                        $subitems,
                        $customerVariables
                    ]
                ]);
            }
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Simulate Change of Signature Plan IUGU
     *
     * Simulates a signature plan change
     */
    public static function simulateChangePlanCheck($idSubscription, $changePlanSimulation)
    {
        try 
        {
            if ($idSubscription && $changePlanSimulation) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/subscriptions/' . $idSubscription . '/change_plan_simulation/' . $changePlanSimulation);
                return $request;
            }
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Subscription Plan IUGU
     *
     * Change the Plan for a Subscription. An Invoice charging change of plan may be generated for the customer
     */
    public static function changeSubscriptionPlan($idSubscription, $changePlan)
    {
        try 
        {
            
            if ($idSubscription && $changePlan) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $changePlanSimulation . '/change_plan/' . $changePlan);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Add Credits to Subscription IUGU
     *
     * Add credits to a subscription
     */
    public static function addCreditOnSignature($idSubscription, $quantity)
    {
        try {
            
            if ($idSubscription && $quantity) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idSubscription . '/add_credits', [
                    'form_params' => [
                        'quantity' => $quantity
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove Subscription Credits
     *
     * Remove credits to a subscription
     */
    public static function removeCreditOnSignature($idSubscription, $quantity)
    {
        try {
            
            if ($idSubscription && $quantity) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idSubscription . '/remove_credits', [
                    'form_params' => [
                        'quantity' => $quantity
                    ]
                ]);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove signature
     *
     * Permanently Removes a Subscription
     */
    public static function removeSignature($idSubscription)
    {
        try {
            
            if ($idSubscription) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/subscriptions/' . $idSubscription);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Subscription
     *
     * Returns the data of a Signature
     */
    public static function searchSignature($idSubscription)
    {
        try 
        {
            
            if ($idSubscription) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/subscriptions/' . $idSubscription);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Subscriptions
     *
     * Returns a list of all signatures in your account sorted by Creation date, the first being the most recently created. 
     * The totalItems field always contains the number of signatures registered, regardless of the search Parameter used 
     * and the search result is always within items.
     */
    public static function listSubscriptions()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/subscriptions');
            return $request;
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Transfer Value IUGU
     *
     * Transfer a certain amount from your account to the target account
     */
    public static function transferValue($idReceiver, $amountCents, $customVariables = null)
    {
        try 
        {
            
            if ($idReceiver && $amountCents) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/transfers', [
                    'form_params' => [
                        'receiver_id' => $idReceiver,
                        'amount_cents' => $amountCents,
                        $customVariables
                    ]
                ]);
            }
            
            return $request;
        }
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Transfer IUGU
     *
     * Returns the information of a transfer of values.
     */
    public static function searchTransfer($idTransfer)
    {
        try 
        {
            if ($idTransfer)
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/transfers/' . $idTransfer);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Transfer IUGU
     *
     * Returns a list of all transfers made.
     */
    public static function listTransfer()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/transfers');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create subaccount IUGU
     *
     * Allows creation of subaccounts (payment accounts) for accounts with marketplace or business partner permission
     */
    public static function createSubaccount($name, $commissionPercent)
    {
        try 
        {
            if ($name && $commissionPercent) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/marketplace/create_account', [
                    'form_params' => [
                        'name' => $name,
                        'commission_percent' => $commissionPercent
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Submit Subaccount Verification IUGU
     *
     * Allows you to send documents for sub-account verification. All sub-accounts must have their documentation verified to issue invoices in prodc mode
     */
    public static function sendSubAccountVerification($idAccount, Debt $debt, Wallet $wallet, $file)
    {
        try 
        {
            if ($idAccount && $debt && $wallet && $file) 
            {
                
                $fileBody = null;
                if ($file) {
                    $fileBody = [
                        'files' => [
                            'id' => ($debt->pgm_pagador_cnpj) ? $debt->pgm_pagador_cnpj : $debt->pgm_pagador_cpf,
                            'cpf' => $debt->pgm_pagador_cpf,
                            'activity' => $file
                        ]
                    ];
                }
                
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/accounts/' . $idAccount . '/request_verification', [
                    'form_params' => [
                        'data' => [
                            'price_range' => $wallet->wal_title,
                            'physical_products' => false,
                            'business_type' => $wallet->wal_title,
                            'person_type' => ($debt->pgm_pagador_cnpj) ? 'Pessoa Jur�dica' : 'Pessoa F�sica',
                            'automatic_transfer' => $wallet->wal_saque_automatico,
                            'cnpj' => $debt->pgm_pagador_cnpj,
                            'cpf' => $debt->pgm_pagador_cpf,
                            'company_name' => $debt->pgm_pagador_razao,
                            'name' => $debt->pgm_pagador_nome,
                            'address' => $debt->pgm_endereco_logradouro,
                            'cep' => $debt->pgm_endereco_cep,
                            'city' => $debt->pgm_endereco_cidade,
                            'state' => $debt->pgm_endereco_estado,
                            'telephone' => $debt->pgm_pagador_celular,
                            'resp_name' => $debt->pgm_pagador_razao,
                            'bank' => $wallet->wal_banco,
                            'bank_ag' => $wallet->wal_agencia,
                            'account_type' => $wallet,
                            'bank_cc' => $wallet->wal_conta
                        ],
                        $fileBody
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Account information IUGU
     *
     * Returns the information for an account. Use the sub-account's LIVE_API_TOKEN on authentication
     */
    public static function accountInformation($idSubAccount)
    {
        try 
        {
            if ($idSubAccount) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/accounts/' . $idSubAccount);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Set Up Account IUGU
     *
     * Set up Parameter for a payment account
     */
    public static function setUpAccount(Debt $debt, Wallet $wallet)
    {
        try 
        {
            if ($debt && $wallet) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/accounts/configuration', [
                    'form_params' => [
                        'commission_percent' => $debt->pgm_comissao_taxa,
                        'auto_withdraw' => $wallet->wal_saque_automatico,
                        'fines' => true,
                        'per_day_interest' => true,
                        'late_payment_fine' => $debt->pgm_comissao_fixo,
                        'auto_advance' => true,
                        'auto_advance_type' => 'days_after_payment',
                        'auto_advance_option' => 20, // Number of days after the payment in which the anticipation will be made
                        'bank_slip' => [
                            'active' => true,
                            'extra_due' => 3, // Expiration Days Extras on Ticket
                            'reprint_extra_due' => 1 // Expiration Days Extras in the second Via do Boleto
                        ],
                        'credit_card' => [
                            'active' => true,
                            'soft_descriptor' => 3, // Description that appears on the Customer Card Invoice
                            'installments' => true,
                            'max_installments' => $debt->pgm_parcelas,
                            'max_installments_without_interest' => $debt->pgm_parcelas_pagas,
                            'two_step_transaction' => false,
                            'installments_pass_interest' => true
                        ],
                        'payment_email_notification' => true,
                        'payment_email_notification_receiver' => $debt->pgm_pagador_email,
                        'early_payment_discount' => false
                    ]
                ]);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Add Banking Domicile IUGU
     *
     * Send data to change bank domicile. Value destination when transferring or withdrawing money
     */
    public static function addBankDomicilio(Wallet $wallet, $document)
    {
        try 
        {
            if ($wallet && $document) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/bank_verification', [
                    'form_params' => [
                        'agency' => $wallet->wal_agencia,
                        'account' => $wallet->wal_conta,
                        'account_type' => 'cc', // Account Type ("cc" for Current Account and "cp" for Savings Account)
                        'bank' => $carteira->wal_banco,
                        'automatic_validation' => tru,
                        'document' => $document
                    
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Verify Sending Bank Address IUGU
     *
     * Check data sent to change bank domicile
     */
    public static function checkSendbankResidence()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->post('https://api.iugu.com/v1/bank_verification');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Withdrawal Request IUGU
     *
     * Make a withdrawal request for a value
     */
    public static function requestWithdrawal($idSubAccount, $value, $customVariables = null)
    {
        try 
        {
            if ($idSubAccount && $value) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/accounts/' . $idSubAccount . '/request_withdraw', [
                    'form_params' => [
                        'amount' => $value,
                        $customVariables
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Accounts IUGU
     *
     * Lists the accounts of a marketplace or business partner.
     */
    public static function listAccounts()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/marketplace');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Renew Api User Tokugan IUGU
     *
     * Renew the user's token of an account
     */
    public static function renewToken()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->post('https://api.iugu.com/v1/profile/renew_access_token');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create API Token IUGU
     *
     * Create a "api_token" in a subaccount
     */
    public static function createToken($idCustomer)
    {
        try 
        {
            if ($idCustomer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/' . $idCustomer . '/api_tokens', [
                    'form_params' => [
                        'api_type' => 'TEST', // changes according to the environment ('TEST' = development and 'LIVE' = production)
                        'description' => 'SmartClick' // API Consumer Description
                    ]
                ]);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove API Token IUGU
     *
     * Remove an "api_token" in a subaccount
     */
    public static function removeToken($idAccount, $idToken)
    {
        try 
        {
            if ($idAccount && $idToken) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/' . Parameter::CLIENTE_ID_IUGU . '/api_tokens/' . $idToken);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List API Tokens IUGU
     *
     * List the "api_tokens" in a subaccount
     */
    public static function listToken($idAccount)
    {
        try 
        {
            if ($idAccount) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/' . $idAccount . '/api_tokens');
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Available Events IUGU
     *
     * Lists all events available for creating a Trigger
     */
    public static function listAvailableEvents()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/web_hooks/supported_events');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create Hook IUGU
     *
     * Create a Hook
     */
    public static function createHook($event, $url, $authorization)
    {
        try 
        {
            if ($event && $url && $authorization) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/web_hooks', [
                    'form_params' => [
                        'event' => $event,
                        'url' => $url,
                        'authorization' => $authorization
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Hook IUGU
     *
     * Change a Hook
     */
    public static function changeHook($idHook, $event, $url, $authorization)
    {
        try 
        {
            if ($idHooks && $event && $url && $authorization) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/web_hooks/' . $idHook, [
                    'form_params' => [
                        'event' => $event,
                        'url' => $url,
                        'authorization' => $authorization
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remover Hook IUGU
     *
     * Remove a Hook
     */
    public static function removeHook($idHook)
    {
        try 
        {
            if ($idHook) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/web_hooks/' . $idHook);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Hook IUGU
     *
     * Search a Hook
     */
    public static function searchHooks($idHook)
    {
        try 
        {
            if ($idHook) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/web_hooks/' . $idHook);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Hooks IUGU
     *
     * List a Hooks
     */
    public static function listHooks()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/web_hooks');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Available Email Identifiers IUGU
     *
     * Returns list of emails available for customization
     */
    public static function listIdentifiersAvailableEmail()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/emails/supported_emails');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Email Standard Layout IUGU
     *
     * Returns standard email layout
     */
    public static function searchLayoutPadraoEmail($identifier)
    {
        try 
        {
            if ($identifier) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/emails/default_layout/' . $identifier);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Create Email IUGU
     *
     * Create a Email
     */
    public static function createEmail($identifier, $template, $subject, $active)
    {
        try 
        {
            if ($identifier && $template && $subject && $active) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/emails', [
                    'form_params' => [
                        'identifier' => $identifier,
                        'template' => $template,
                        'subject' => $subject,
                        'active' => $active
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Change Email IUGU
     *
     * Change um Email
     */
    public static function changeEmail($idEmail, $identifier, $template, $subject, $active)
    {
        try 
        {
            if ($idEmail && $identifier && $template && $subject && $active) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/emails/' . $idEmail, [
                    'form_params' => [
                        'identifier' => $identifier,
                        'template' => $template,
                        'subject' => $subject,
                        'active' => $active
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Remove Email IUGU
     *
     * Remove a Email
     */
    public static function removeEmail($idEmail)
    {
        try 
        {
            if ($idEmail) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/emails/' . $idEmail);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * View Email Template IUGU
     *
     * Returns template saved for certain email
     */
    public static function viewTemplateEmail($identifier)
    {
        try 
        {
            if ($identifier) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/emails/preview/' . $identifier);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Send Test Email IUGU
     *
     * Send real email for layout view
     */
    public static function sendEmail($identifier, $to)
    {
        try 
        {
            if ($identifier && $to) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/emails/test/' . $identifier, [
                    'form_params' => [
                        'to' => $to
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Email IUGU
     *
     * Returns the data of a given email
     */
    public static function searchEmail($idEmail)
    {
        try 
        {
            if ($idEmail) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/emails/' . $idEmail);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Emails IUGU
     *
     * Returns the mailing list
     */
    public static function listEmails()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/emails/');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Bank Transfer IUGU
     *
     * Returns information for a bank transfer
     */
    public static function searchBankTransfer($idTransfer)
    {
        try 
        {
            if ($idTransfer) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/withdraw_requests/' . $idTransfer);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Bank Transfer IUGU
     *
     * Returns the list of all bank transfers
     */
    public static function listBankTransfers()
    {
        try
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/withdraw_requests');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Receivables IUGU
     *
     * Returns the list of receivables
     */
    public static function listReceivables()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/financial_transaction_requests');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Simulate Prepayment of Receivables IUGU
     */
    public static function simulateAnticipatedReceivables()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/financial_transaction_requests/advance_simulation');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Anticipate Receivables IUGU
     */
    public static function anticipateReceivables($transactions)
    {
        try 
        {
            if ($transactions) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/financial_transaction_requests/advance', [
                    'form_params' => [
                        'transactions' => $transactions
                    ]
                ]);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Dispute Contestation IUGU
     *
     * Opens a dispute over the dispute.
     */
    public static function disputeContestation($idContestation, $files)
    {
        try 
        {
            if ($idContestation && $files) 
            {
                $body = array();
                if (is_array($files)) 
                {
                    foreach ($files as $key => $file) 
                    {
                        $body['file' . $key] = $file;
                    }
                }
                
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/chargebacks/' . $idContestation . '/contest', $body);
                
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Obey contestation IUGU
     *
     * Obey the request for contestation.
     */
    public static function obeyContestation($idContestation)
    {
        try 
        {
            if ($idContestation) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/chargebacks/' . $idContestation . '/accept');
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Contest IUGU
     *
     * Returns information from a dispute
     */
    public static function searchContestation($idContestation)
    {
        try 
        {
            if ($idContestation) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/chargebacks/' . $idContestation);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * List Contestation IUGU
     *
     * Returns a list of all the contests in your account
     */
    public static function listContestation()
    {
        try 
        {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/chargebacks');
            return $request;
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Financial Statement IUGU
     *
     * Returns the financial statement of an account.
     */
    public static function financialStatement()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/accounts/financial');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Invoice Statement IUGU
     *
     * Returns the invoice statement of an account
     */
    public static function extractInvoices()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/accounts/invoices');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get Custons Variables
     */
    public static function getCustonVariables($name, $value)
    {
        return [
            'custom_variables' => [
                'name' => $name,
                'value-Type' => $value
            ]
        ];
    }

    /**
     * Get Items
     */
    public static function getItems($description, $quantity, $price_cents, $_destroy = false)
    {
        return [
            'items' => [
                'description' => $description,
                'quantity' => $quantity,
                'price_cents' => $price_cents,
                '_destroy' => $_destroy
            ]
        ];
    }

    /**
     * Get Sub Items
     */
    public static function getSubItems($description, $price_cents, $quantity, $recurrent)
    {
        return [
            'subitems' => [
                'description' => $description,
                'price_cents' => $price_cents,
                'quantity' => $quantity,
                'recurrent' => $recurrent
            ]
        ];
    }

    /**
     * Get Fertures
     */
    public static function getFeatures($debt, $identifier, $value)
    {
        return [
            'features' => [
                'name' => $name,
                'identifier' => $identifier,
                'value' => $value
            ]
        ];
    }

    /**
     * Get Logs
     */
    public static function getLogs()
    {
        return [
            'logs' => [
                'description' => 'Smart CLic',
                'notes' => date('d/m/Y H:i:s')
            ]
        ];
    }

    /**
     * Get Payment discount - Discount set to be applied
     */
    public static function getPaymentDiscounts($days, $percent)
    {
        return [
            'early_payment_discounts' => [
                'days' => $days,
                'percent' => $percent
            ]
        ];
    }

    /**
     * Create Payer IUGU
     */
    private static function getPayer($debt)
    {
        return [
            "cpf_cnpj" => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
            "name" => $debt->pgm_pagador_nome,
            "phone_prefix" => substr($debt->pgm_pagador_celular, 0, 2),
            "phone" => substr($debt->pgm_pagador_celular, 2),
            "email" => $debt->pgm_pagador_email,
            "address" => self::getPayerAddress($divida)
        ];
    }

    /**
     * Create Payer Address IUGU
     */
    private static function getPayerAddress($debt)
    {
        return [
            "street" => $debt->pgm_endereco_logradouro,
            "number" => $debt->pgm_endereco_numero,
            "district" => $debt->pgm_endereco_bairro,
            "city" => $debt->pgm_endereco_cidade,
            "state" => $debt->pgm_endereco_estado,
            "complement" => $debt->pgm_endereco_complemento
        ];
    }

    /**
     * Get Headers
     */
    private static function getHeaders()
    {
        return [
            'headers' => [
                'Authorization' => 'Basic ' . Parameter::getTokenIugu(),
                'Content-Type' => 'application/json'
            ]
        ];
    }
}
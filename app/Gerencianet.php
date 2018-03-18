<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Gerencianet\Exception\GerencianetException;
use Carbon\Carbon;
use App\Parameter;


class Gerencianet extends Model
{

    /**
     * Create Transaction GenreciaNet
     *
     * Create a transaction by GerenciaNet
     */
    public static function createTransaction($nome, $quantidade, $valor)
    {
        try {
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($nome, $quantidade, $valor));
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update Transactions GenreciaNet
     *
     * You are in: "Other API Features> Update Transactions"
     */
    public static function updateTranslation($idTransaction, $url)
    {
        try {
            $params = [
                'id' => $idTransaction
            ];
            
            $body = [
                'custom_id' => Parameter::CLIENTE_ID_GERENCIA_NET, // to associate Gerencianet transaction with its own identifier
                'notification_url' => $url // notification url
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Detail Transactions GenreciaNet
     *
     * You are in: "Other API Features> Detail Transactions"
     */
    public static function detailTransactions($idTransaction)
    {
        try {
            
            $params = [
                'id' => $idTransaction
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->detailCharge($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancel Transactions GenreciaNet
     *
     * You are in: "Other API Features> Cancel Transactions"
     */
    public static function cancelTranslation($idTransaction)
    {
        try {
            $params = [
                'id' => $idTransaction
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->cancelCharge($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Creating signatures
     *
     * You are in: "Subscriptions (Recurrence)> Creating subscriptions"
     */
    public static function createSignature($name, $interval = 1, $repeats = null)
    {
        try {
            $body = [
                'name' => $name, // nome do plano de assinatura
                'interval' => $interval, // periodicidade da cobran�a (em meses) - informe 1 para assinatura mensal
                'repeats' => $repeats // n�mero de vezes que a cobran�a deve ser gerada (padr�o: null, que significa que a cobran�a � gerada por tempo indeterminado ou at� que o plano seja cancelado)
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createPlan([], $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Create subscriptions (signatures) to link to the plan
     */
    public static function createInscriptionSignature($id, $name, $amount, $value)
    {
        try {
            
            $item = [
                'name' => $name, // nome do item, produto ou servi�o
                'amount' => $amount, // quantidade
                'value' => $value // valor (1000 = R$ 10,00)
            ];
            
            $body = [
                'items' => [
                    $item
                ]
            ];
            
            $params = [
                'id' => $id
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createSubscription($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Changing notification_url and / or custom_id of signatures
     */
    public static function changeSubscription($idSignature, $url, $isTransacao)
    {
        try {
            
            $$params = [
                'id' => $idSignature
            ];
            
            $body = [
                'notification_url' => $url,
                'custom_id' => $isTransacao
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->updateSubscriptionMetadata($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Define the form of payment of the signature and the data of the client
     */
    public static function paySignature($idSignature, $name, $cpf, $phone_number, $expire_at = 5)
    {
        try {
            
            $params = [
                'id' => $idSignature
            ];
            
            $customer = [
                'name' => $name,
                'cpf' => $cpf,
                'phone_number' => $phone_number
            ];
            
            $current = Carbon::now();
            $expire_at = $current->addDays($expire_at);
            
            $body = [
                'payment' => [
                    'banking_billet' => [
                        'expire_at' => $expire_at->format('Y-m-d'),
                        'customer' => $customer
                    ]
                ]
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->paySubscription($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * List existing subscription plans
     */
    public static function listSignature($limit, $offset)
    {
        try {
            
            $params = [
                'limit' => $limit,
                'offset' => $offset
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->getPlans($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Detail subscription information
     *
     * You are in: "Other API Features> Detail Transactions"
     */
    public static function detailSubscription($idSignature)
    {
        try {
            
            $params = [
                'id' => $idSignature
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->detailSubscription($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancels a subscription plan
     */
    public static function deleteSubscription($idSignature)
    {
        try {
            
            $params = [
                'id' => $idSignature
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->deletePlan($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancel active signatures on a plan
     */
    public static function cancelSubscriptions($idSignature)
    {
        try {
            
            $params = [
                'id' => $idSignature
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->cancelSubscription($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criando carn�s
     *
     * Voc� est� em: "Carn�s > Criando carn�s"
     */
    public static function criarCarne(Debt $debt, $name, $amount, $value, $expire_at = 5, $repeats = 5)
    {
        try {
            
            $item = [
                'name' => $name, // nome do item, produto ou servi�o
                'amount' => $amount, // quantidade
                'value' => $value // valor (1000 = R$ 10,00)
            ];
            
            $customer = [
                'name' => $debt->pgm_pagador_nome,
                'cpf' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                'phone_number' => $debt->pgm_pagador_celular
            ];
            
            $current = Carbon::now();
            $expire_at = $current->addDays($expire_at);
            
            $body = [
                'items' => [
                    $item
                ],
                'customer' => $customer,
                'expire_at' => $expire_at->format('Y-m-d'), // due date of the first installment of the card
                'repeats' => $repeats, // number of installments
                'split_items' => false
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCarnet([], $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Returns information about a created card
     *
     * You are in: "Cards > Creating cards"
     */
    public static function searchCarnet($idCarnet)
    {
        try {
            
            $params = [
                'id' => $idCarnet
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->detailCarnet($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterando notification_url e/ou custom_id de carn�s
     */
    public static function changeCarnet($idCarnet, $idTransaction, $url)
    {
        try {
            
            $params = [
                'id' => $idCarnet
            ];
            
            $body = [
                'custom_id' => $idTransaction,
                'notification_url' => $url
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->updateCarnetMetadata($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterando notification_url e/ou custom_id de carn�s
     */
    public static function alterarVencimentoCarne($idCarnet, $parcel, $expire_at = 1)
    {
        try {
            
            $params = [
                'id' => $idCarnet,
                'parcel' => $parcel
            ];
            
            $current = Carbon::now();
            $expire_at = $current->addDays($expire_at);
            
            $body = [
                'expire_at' => $expire_at->format('Y-m-d')
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->updateParcel($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancelar um determinado carn�
     */
    public static function cancelarCarne($idCarne, $expire_at = 1)
    {
        try {
            
            $params = [
                'id' => $idCarne
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->cancelCarnet($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancelar parcela espec�fica de um carn� existente
     */
    public static function cancelarParcelaCarne($idCarne, $parcela)
    {
        try {
            
            $params = [
                'id' => $idCarne,
                'parcel' => $parcela
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->cancelParcel($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Reenviar carn� por email
     */
    public static function reenviarCarnePorEmail($idCarnet, $email)
    {
        try {
            
            $params = [
                'id' => $idCarnet
            ];
            
            $body = [
                'email' => $email
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->resendCarnet($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Resend specific parcel of card by email
     */
    public static function resendPortionByEmail($idCarnet, $parcel, $email)
    {
        try {
            
            $params = [
                'id' => $idCarnet,
                'parcel' => $parcel
            ];
            
            $body = [
                'email' => $email
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->resendParcel($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Add information to the history of the card
     */
    public static function addCarnetInformation($idCarnet, $description)
    {
        try {
            
            $params = [
                'id' => $idCarnet
            ];
            
            $body = [
                'description' => $description
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCarnetHistory($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Setting the URL for receiving notifications
     */
    public static function setMetadata($nome, $quantidade, $valor, $url)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou servi�o
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (1000 = R$ 10,00)
            ];
            
            $metadata = array(
                'notification_url' => $url
            );
            
            $body = [
                'items' => [
                    $item
                ],
                'metadata' => $metadata
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Querying notification details
     */
    public static function consultNotification()
    {
        try {
            
            $params = [
                'token' => Parameter::PAYMENT_TOKEN_GERENCIA_NET
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->getNotification($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Issue Ticket GenreciaNet
     *
     * Create a ticket in GerenciaNet
     */
    public static function issueTicket(Debt $debt, $expire_at = 5)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($debt->pgm_pagador_nome, 1, $debt->pgm_valor));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $customer = [
                    'name' => $debt->pgm_pagador_nome,
                    'cpf' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                    'phone_number' => $debt->pgm_pagador_celular
                ];
                
                $current = Carbon::now();
                $expire_at = $current->addDays($expire_at);
                
                $bankingBillet = [
                    'expire_at' => $expire_at->format('d/m/Y H:i:s'),
                    'customer' => $customer
                ];
                
                $body = [
                    'payment' => [
                        'banking_billet' => $bankingBillet
                    ]
                ];
                
                $api = new Gerencianet(self::getOptions());
                $pay_charge = $api->payCharge($params, $body);
                
                return $pay_charge;
            }
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Pay with legal person by GenreciaNet
     *
     * You are in: "Other API Resources> Paying with Legal Entity"
     */
    public static function issueTicketLegalPerson(Debt $debt, $expire_at = 5)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($debt->pgm_pagador_nome, 1, $debt->pgm_valor));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $juridical_data = [
                    'corporate_name' => $debt->pgm_pagador_razao,
                    'cnpj' => $debt->pgm_pagador_cnpj
                ];
                
                $customer = [
                    'name' => $debt->pgm_pagador_nome,
                    'cpf' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                    'phone_number' => $debt->pgm_pagador_celular,
                    'juridical_person' => $juridical_data
                ];
                
                $current = Carbon::now();
                $expire_at = $current->addDays($expire_at);
                
                $bankingBillet = [
                    'expire_at' => $expire_at->format('d/m/Y H:i:s'),
                    'customer' => $customer
                ];
                
                $body = [
                    'payment' => [
                        'banking_billet' => $bankingBillet
                    ]
                ];
                
                $api = new Gerencianet(self::getOptions());
                $pay_charge = $api->payCharge($params, $body);
                
                return $pay_charge;
            }
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Define Addresses GenreciaNet
     *
     * You are in: "Other API Features> Define Addresses"
     */
    public static function setTicketAddress(Debt $debt, $idTransaction)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            
            $params = [
                'id' => $idTransaction
            ];
            
            $customer = [
                'name' => $debt->pgm_pagador_nome,
                'cpf' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                'phone_number' => $debt->pgm_pagador_celular
            ];
            
            $billingAddress = [
                'street' => $debt->pgm_endereco_logradouro,
                'number' => $debt->pgm_endereco_numero,
                'neighborhood' => $debt->pgm_endereco_bairro,
                'zipcode' => $debt->pgm_endereco_cep,
                'city' => $debt->pgm_endereco_cidade,
                'state' => $debt->pgm_endereco_estado
            ];
            
            $creditCard = [
                'installments' => $debt->pgm_parcelas, // n�mero de parcelas em que o pagamento deve ser dividido
                'billing_address' => $billingAddress,
                'payment_token' => Parameter::PAYMENT_TOKEN_GERENCIA_NET,
                'customer' => $customer
            ];
            
            $payment = [
                'credit_card' => $creditCard
            ];
            
            $body = [
                'payment' => $payment
            ];
            
            $api = new Gerencianet(self::getOptions());
            $pay_charge = $api->payCharge($params, $body);
            
            return $pay_charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Pay Card GenreciaNet
     *
     * Pay card by GerenciaNet
     */
    public static function payCard(Debt $debt)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($debt->pgm_pagador_nome, 1, $debt->pgm_valor));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $customer = [
                    'name' => $debt->pgm_pagador_razao,
                    'cpf' => $debt->pgm_pagador_cpf,
                    'phone_number' => $debt->pgm_pagador_celular,
                    'email' => $debt->pgm_pagador_email,
                    'birth' => $debt->pgm_pagador_nascimento
                ];
                
                $billingAddress = [
                    'street' => $debt->pgm_endereco_logradouro,
                    'number' => $debt->pgm_endereco_numero,
                    'neighborhood' => $debt->pgm_endereco_bairro,
                    'zipcode' => $debt->pgm_endereco_cep,
                    'city' => $debt->pgm_endereco_cidade,
                    'state' => $debt->pgm_endereco_estado // Verificar o estado do cliente
                ];
                
                $creditCard = [
                    'installments' => $debt->pgm_cartao_codigo, // Verificar installments do cliente
                    'billing_address' => $billingAddress,
                    'payment_token' => Parameter::PAYMENT_TOKEN_GERENCIA_NET,
                    'customer' => $customer
                ];
                
                $body = [
                    'payment' => [
                        'credit_card' => $creditCard
                    ]
                ];
                
                $api = new Gerencianet(self::getOptions());
                $charge = $api->payCharge($params, $body);
                
                return $charge;
            }
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * List Card Parcel GenreciaNet
     *
     * You are in: "Other API Features > List Card Parcels"
     */
    public static function listParcelCard($total, $brand)
    {
        try {
            
            $params = [
                'total' => $total,
                'brand' => $brand
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->getInstallments($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Marketplace GenreciaNet
     */
    public static function payMarketplace(Debt $debt, $payee_code, $percentage, $name, $amount, $value, $repasses = array())
    {
        try {
            
            $items = [
                [
                    'name' => $name,
                    'amount' => $amount,
                    'value' => $value,
                    'marketplace' => array(
                        'repasses' => $repasses
                    )
                ]
            ];
            
            $body = [
                'items' => $items
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], $body);
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $customer = [
                    'name' => $debt->pgm_pagador_nome,
                    'cpf' => ($debt->pgm_pagador_cpf) ? $debt->pgm_pagador_cpf : $debt->pgm_pagador_cnpj,
                    'phone_number' => $debt->pgm_pagador_celular,
                    'email' => $debt->pgm_pagador_email,
                    'birth' => $debt->pgm_pagador_nascimento
                ];
                
                $billingAddress = [
                    'street' => $debt->pgm_endereco_logradouro,
                    'number' => $debt->pgm_endereco_numero,
                    'neighborhood' => $debt->pgm_endereco_bairro,
                    'zipcode' => $debt->pgm_endereco_cep,
                    'city' => $debt->pgm_endereco_cidade,
                    'state' => $debt->pgm_endereco_estado
                ];
                
                $creditCard = [
                    'installments' => (int) $_POST["installments"],
                    'billing_address' => $billingAddress,
                    'payment_token' => Parameter::PAYMENT_TOKEN_GERENCIA_NET,
                    'customer' => $customer
                ];
                
                $payment = [
                    'credit_card' => $creditCard
                ];
                
                $body = [
                    'payment' => $payment
                ];
                
                try {
                    $api = new Gerencianet(self::getOptions());
                    $charge = $api->payCharge($params, $body);
                    
                    return $charge;
                } catch (GerencianetException $e) {
                    return $e;
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            }
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Dividing receipts GenreciaNet
     *
     * You are here: Marketplace > Dividing receipts"
     */
    public static function dividirRecebimentoMarketplace(Debt $debt, $name, $amount, $value, $repasses = array())
    {
        try {
            
            $items = [
                [
                    'name' => $name,
                    'amount' => $amount,
                    'value' => $value,
                    'marketplace' => array(
                        'repasses' => $repasses
                    )
                ]
            ];
            
            $body = [
                'items' => $items
            ];
            
            try {
                $api = new Gerencianet(self::getOptions());
                $charge = $api->createCharge([], $body);
                
                return $charge;
            } catch (GerencianetException $e) {
                return $e;
            } catch (\Exception $e) {
                return $e->getMessage();
            }
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Creating GenreciaNet payment link
     *
     * You are in: "Payment Link > Creating Payment Link"
     */
    public static function emitLink($name, $amount, $value, $message, $expire_at, $request_delivery_address = true, $payment_method)
    {
        try {
            
            $items = [
                [
                    'name' => $name,
                    'amount' => $amount,
                    'value' => $value
                ]
            ];
            
            $body = [
                'items' => $items
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], $body);
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $body = [
                    // 'billet_discount' => 1,
                    // 'card_discount' => 1,
                    'message' => $message,
                    'expire_at' => $expire_at,
                    // 'request_delivery_address' => (boolean) $_POST["request"],
                    'request_delivery_address' => $request_delivery_address,
                    'payment_method' => $payment_method
                ];
                
                $api = new Gerencianet(self::getOptions());
                $response = $api->linkCharge($params, $body);
                
                return $response;
            }
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * Returns transfers
     *
     */
    public static function getTransfers($idUser1, $percentage1, $idUser2, $percentage2)
    {
        $repass_1 = [
            'payee_code' => $idUser1, // identificador da conta Gerencianet (repasse 1)
            'percentage' => $percentage1 // porcentagem de repasse (2500 = 25%)
        ];
        
        $repass_2 = [
            'payee_code' => $idUser2, // identificador da conta Gerencianet (repasse 2)
            'percentage' => $percentage2 // porcentagem de repasse (1500 = 15%)
        ];
        
        $repasses = [
            $repass_1,
            $repass_2
        ];
        
        return $repasses;
    }

    /**
     * Detail carnet information
     *
     * You are in: "Other API Features> Detail Transactions"
     */
    public static function detailCarnet($idCarnet)
    {
        try {
            
            $params = [
                'id' => $idCarnet
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->detailCarnet($params, []);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Resubmitting a bank draft by email GenreciaNet
     *
     * You are in: "Other API Resources> Resubmit Transactions"
     */
    public static function resendEmailBanking($idTransaction, $email)
    {
        try {
            
            $params = [
                'id' => $idTransaction
            ];
            
            $body = [
                'email' => $email
            ];
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->resendBillet($params, $body);
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Get Options
     */
    private static function getOptions()
    {
        return [
            'client_id' => Parameter::getClienteIdGerenciaNet(),
            'client_secret' => Parameter::getSecretGerenciaNet(),
            'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = produ��o)
        ];
    }

    /**
     * Get Body
     */
    private static function getBody($name, $amount, $value)
    {
        return [
            'items' => [
                [
                    'name' => $name,
                    'amount' => $amount,
                    'value' => $value
                ]
            ]
        ];
    }
}

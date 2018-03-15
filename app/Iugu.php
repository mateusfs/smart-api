<?php
namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Iugu extends Model
{
    /**
     * Emetir Boleto IUGU
     *
     */
    public static function issueTicket(Debets $divida)
    {
        try {
            if ($divida) {
                $idCliente = Parametros::CLIENTE_ID_IUGU;
                
                $token = Iugu::criarToken($idCliente);
                
                $formaDePamanto = Iugu::criarFormaPagamento($idCliente);
                
                $items = Iugu::getItems($debet->pgm_pagador_nome, 1, $debet->pgm_valor);
                
                if($formaDePamanto && $items){
                    $result = self::cobrancaDireta($debets, 'bank_slip', $token, $formaDePamanto['id'], true, $idCliente, '', $debet->pgm_pagador_email, $debet->pgm_parcelas, null, 5, $items);
                }
                
                return $result;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Emetir Cartao IUGU
     *
     */
    public static function emetirCartao(Debets $divida)
    {
        try {
            if ($divida) {
                $idCliente = Parametros::CLIENTE_ID_IUGU;
                
                $token = Iugu::criarToken($idCliente);
                
                $formaDePamanto = Iugu::criarFormaPagamento($idCliente);
                
                $returnUrl = 'http://smartclic.com.br/';
                
                $expiredUrl = 'http://smartclic.com.br/';
                
                $emails = $debet->pgm_pagador_email.',smart@smartclic.com.br';
                
                $fatura = Iugu::criarFatura($debet->pgm_pagador_email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, false, '', '', $idCliente, false, null, 'credit_card');
                
                $items = Iugu::getItems($debet->pgm_pagador_razao, 1, $debet->pgm_valor);
                
                if($formaDePamanto && $items){
                    $result = self::cobrancaDireta($debets, '', $token, $formaDePamanto['id'], true, $idCliente, $fatura['id'], $debet->pgm_pagador_email, $debet->pgm_parcelas, null, 5, $items);
                }
                
                return $result;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    
    /**
     * Criar Fatura IUGU
     *
     * Cria uma Fatura para um Cliente (Podendo ser um objeto cliente ou apenas um e-mail).
     */
    public static function criarFatura($email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, $temMulta, $multa, $cobrarJuros = true, $desconto, $idCliente, $ignoreEmail = false, $idAssinatura = null, $metodoDePagamento = 'all', $creditoDaAssinatura = null, $temDesconto = false, $logs = null, $paymenDiscounts = null, $custonVariables = null)
    {
        try {
            if ($divida) {
                
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices', [
                    'form_params' => [
                        'email' => $email,
                        'cc_emails' => $emails,
                        'due_date' => ($dataVencimento) ? $dataVencimento : date('Y-m-d') + 3,
                        'ensure_workday_due_date' => true,
                        $items, // OBRIGATÓRIO - Itens da fatura. "price_cents" valor mínimo 100
                        'return_url' => $returnUrl,
                        'expired_url' => $expiredUrl,
                        'fines' => $temMulta, // Booleano para Habilitar ou Desabilitar multa por atraso de pagamento
                        'late_payment_fine' => $multa,
                        'per_day_interest' => $cobrarJuros,
                        'discount_cents' => $desconto,
                        'customer_id' => $idCliente,
                        'ignore_due_email' => $ignoreEmail,
                        'subscription_id' => $idAssinatura,
                        'payable_with' => $metodoDePagamento,
                        'credits' => $creditoDaAssinatura,
                        'early_payment_discount' => $temDesconto,
                        'payer' => self::getPayer($divida),
                        $logs,
                        $paymenDiscounts,
                        $custonVariables
                    
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Capturar Fatura IUGU
     *
     * Captura uma fatura com estado "Em Análise" / "in_analysis".
     */
    public static function capturarFatura($idFatura)
    {
        try {
            if ($idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura . '/capture', [
                    'form_params' => [
                        'id' => $idFatura
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Reembolsar Fatura IUGU
     *
     * Efetua o reembolso de uma Fatura. Somente alguns meios de pagamento permitem o reembolso, como por exemplo o
     * Cartão de Crédito. Após o reembolso, a Fatura fica com o status de "reembolsada" / "refunded".
     */
    public static function reembolsarFatura($idFatura)
    {
        try {
            if ($idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura . '/refund', [
                    'form_params' => [
                        'id' => $idFatura
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cancelar Fatura IUGU
     *
     * Cancela uma Fatura
     */
    public static function cancelarFatura($idFatura)
    {
        try {
            if ($idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura . '/cancel', [
                    'form_params' => [
                        'id' => $idFatura
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Gerar 2ª via de fatura IUGU
     *
     * Gera a segunda via de uma fatura com o status "pendente". A fatura atual é cancelada e uma nova é criada com o mesmo status.
     */
    public static function gerarSegundaViaFatura(Debets $debets, $idFatura, $items = nulkl)
    {
        try {
            if ($divida && $idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura . '/duplicate', [
                    'form_params' => [
                        'id' => $idFatura,
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
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Fatura IUGU
     *
     * Retorna os dados de uma Fatura.
     */
    public static function buscarFatura($idFatura)
    {
        try {
            if ($idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura, [
                    'form_params' => [
                        'id' => $debet->pgm_id_fatura_iugu
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Faturas IUGU
     *
     * Retorna uma lista das faturas em sua conta ordenadas pela data de criação, da mais à menos recente. Por padrão, este
     * endpoint retorna no máximo 100 registros. O campo "totalItems" contém sempre a quantidade total de faturas cadastradas,
     * independentemente dos parâmetros de pesquisa utilizados, e o resultado da pesquisa fica sempre dentro de "items".
     */
    public static function listarFaturas()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/invoices/');
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Enviar por email IUGU
     *
     * Envia a fatura iugu para o email vinculado a ela.
     */
    public static function enviarEmailFatura($idFatura)
    {
        try {
            if ($idFatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/invoices/' . $idFatura . 'send_email', [
                    'form_params' => [
                        'id' => $debet->pgm_id_fatura_iugu
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Cobrança Direta IUGU
     *
     * Cobrança simples via boleto ou cartão de crédito.
     */
    public static function cobrancaDireta($debets, $metodoDePagamento = 'bank_slip', $token = null, $idFormaDePamanto = null, $restrigirMetodo = true, $idCliente = null, $idFatura = null, $email = null, $numeroDeParcelas, $valorDoDesconto = null, $prazoEmDias = 3, $items = null)
    {
        try {
            
            if ($divida) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/charge', [
                    'form_params' => [
                        'method' => $metodoDePagamento,
                        'token' => $token,
                        'customer_payment_method_id' => $idFormaDePamanto,
                        'restrict_payment_method' => $restrigirMetodo, // Se true, restringe o método de pagamento da cobrança para o definido em method.
                        'customer_id' => $idCliente,
                        'invoice_id' => $idFatura,
                        'email' => $email, // E-mail do Cliente (não é preenchido caso seja enviado um "invoice_id")
                        'months' => $numeroDeParcelas,
                        'discount_cents' => $valorDoDesconto,
                        'bank_slip_extra_days' => $prazoEmDias,
                        'keep_dunning' => true,
                        'payer' => self::getPayer($divida),
                        $items
                    ]
                ]);
            }
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criar Cliente IUGU
     *
     * Cria um objeto cliente
     */
    public static function criarCliente(Debets $debets, $customVariables = null)
    {
        try {
            if ($divida) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/customers', [
                    'form_params' => [
                        'email' => $debet->pgm_pagador_email,
                        'name' => $debet->pgm_pagador_nome,
                        'phone' => substr($debet->pgm_pagador_celular, 2),
                        'phone_prefix' => substr($debet->pgm_pagador_celular, 0, 2),
                        'cpf_cnpj' => ($debet->pgm_pagador_cpf) ? $debet->pgm_pagador_cpf : $debet->pgm_pagador_cnpj,
                        'cc_emails' => $debet->pgm_pagador_email,
                        'zip_code' => $debet->pgm_endereco_cep,
                        'number' => $debet->pgm_endereco_numero,
                        'street' => $debet->pgm_endereco_logradouro,
                        'city' => $debet->pgm_endereco_cidade,
                        'state' => $debet->pgm_endereco_estado,
                        'district' => $debet->pgm_endereco_bairro,
                        'complement' => $debet->pgm_endereco_complemento,
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
     * Alterar Cliente IUGU
     *
     * Alterar os dados de um Cliente. Quaisquer parâmetros não informados não serão alterados.
     */
    public static function alterarCliente(Debets $debets, $idFormaPagamento = null, $customVariables = null)
    {
        try {
            if ($divida) {
                $client = new Client(self::getHeaders());
                
                $request = $client->put('https://api.iugu.com/v1/customers/' . Parametros::CLIENTE_ID_IUGU, [
                    'form_params' => [
                        'email' => $debet->pgm_pagador_email,
                        'name' => $debet->pgm_pagador_nome,
                        'notes' => $debet->pgm_intermediario_status,
                        "phone" => substr($debet->pgm_pagador_celular, 2),
                        "phone_prefix" => substr($debet->pgm_pagador_celular, 0, 2),
                        'cpf_cnpj' => ($debet->pgm_pagador_cpf) ? $debet->pgm_pagador_cpf : $debet->pgm_pagador_cnpj,
                        'cc_emails' => $debet->pgm_pagador_email,
                        'zip_code' => $debet->pgm_endereco_cep,
                        'number' => $debet->pgm_endereco_numero,
                        'street' => $debet->pgm_endereco_logradouro,
                        'city' => $debet->pgm_endereco_cidade,
                        'state' => $debet->pgm_endereco_estado,
                        'district' => $debet->pgm_endereco_bairro,
                        'complement' => $debet->pgm_endereco_complemento,
                        'default_payment_method_id' => $idFormaPagamento,
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
     * Remover Cliente IUGU
     *
     * Remove permanentemente um cliente. Porém, não permite remover clientes com assinaturas ou faturas vinculadas.
     */
    public static function removerCliente($idCustomer)
    {
        try {
            if ($idCustomer) {
                $client = new Client(self::getHeaders());
                $request = $client->delte('https://api.iugu.com/v1/customers/' . $idCustomer);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Cliente IUGU
     *
     * Retorna os dados de um cliente
     */
    public static function buscarCliente($idCustomer)
    {
        try {
            if ($idCustomer) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Clientes IUGU
     *
     * Retorna uma lista com todos os clientes cadastrados em sua conta ordenados pela data de Criação, sendo o primeiro o
     * que foi criado mais recentemente. O campo "totalItems" contém sempre a quantidade de clientes cadastrados,
     * independente dos parâmetros de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de "items".
     */
    public static function listarClientes()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/customers/');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criar Forma de Pagamento IUGU
     *
     * Cria uma Forma de Pagamento de Cliente.
     */
    public static function criarFormaPagamento($idCustomer, $token)
    {
        try {
            
            if ($idCustomer) {
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
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterar Forma de Pagamento IUGU
     *
     * Cria uma Forma de Pagamento de Cliente.
     */
    public static function alterarFormaPagamento($idCustomer, $idPayment)
    {
        try {
            if ($idCustomer && $idPayment) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment, [
                    'form_params' => [
                        'description' => 'SmartClic'
                    ]
                ]);
                
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remover Forma de Pagamento IUGU
     *
     * Remove permanentemente uma forma de pagamento de um cliente.
     */
    public static function removerFormaPagamento($idCustomer, $idPayment)
    {
        try {
            if ($idCustomer && $idPayment) {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment, [
                    'form_params' => [
                        'description' => 'SmartClic'
                    ]
                ]);
                
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Forma de Pagamento IUGU
     *
     * Retorna os dados de uma Forma de Pagamento de um Cliente
     */
    public static function buscarFormaPagamento($idCustomer, $idPayment)
    {
        try {
            if ($idCustomer && $idPayment) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods/' . $idPayment);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Formas de Pagamento IUGU
     *
     * Retorna uma lista com todas as formas de pagamento de determinado cliente
     */
    public static function listarFormaPagamento($idCustomer)
    {
        try {
            if ($idCustomer) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/customers/' . $idCustomer . '/payment_methods');
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criar Plano IUGU
     *
     * Cria um plano
     */
    public static function criarPlano($identificador, $nome, $intervalo, $tipoIntervalo = 'months', $valor, $metodo = 'bank_slip', $features = null)
    {
        try {
            if ($identificador) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/plans', [
                    'form_params' => [
                        'name' => $nome,
                        'identifier' => $identificador,
                        'interval' => $intervalo, // Ciclo do plano (Número inteiro maior que 0)
                        'interval_type' => $tipoIntervalo, // Tipo de interval ("weeks" ou "months")
                        'value_cents' => $valor,
                        'payable_with' => $metodoPlano,
                        $features
                    ]
                ]);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterar Plano IUGU
     *
     * Altera os dados de um Plano, quaisquer parâmetros não informados não serão alterados. As alterações não irão mudar as Assinaturas que já utilizam o Plano, mas só as novas.
     */
    public static function alterarPlano($idPlano, $nome, $intervalo, $tipoIntervalo = 'months', $valor, $metodo = 'bank_slip', $features = null)
    {
        try {
            if ($idPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/plans/' . $idPlano, [
                    'form_params' => [
                        'name' => $nome,
                        'interval' => $intervalo, // Ciclo do plano (Número inteiro maior que 0)
                        'interval_type' => $tipoIntervalo, // Tipo de interval ("weeks" ou "months")
                        'value_cents' => $valor,
                        'payable_with' => $metodoPlano,
                        $features
                    ]
                ]);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remover Plano IUGU
     *
     * Remove os dados de um Plano
     */
    public static function removerPlano($idPlano)
    {
        try {
            if ($idPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/plans/' . $idPlano);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Plano IUGU
     *
     * Retorna os dados de um Plano
     */
    public static function buscarPlano($idPlano)
    {
        try {
            if ($idPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/plans/' . $idPlano);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Plano pelo Identificador IUGU
     *
     * Retorna os dados de um plano utilizando um identificador.
     */
    public static function buscarPlanoPeloIdentificador($identificador)
    {
        try {
            if ($identificador) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/plans/identifier/' . $identificador);
                return json_decode($request->getBody()->getContents());
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Planos IUGU
     *
     * Retorna uma lista com todos os planos em sua conta ordenadas pela data de Criação, sendo o primeiro o criado mais
     * recentemente. O campo totalItems contém sempre a quantidade de planos cadastrados, independente dos parâmetros
     * de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de items.
     */
    public static function listarPlanos()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/plans');
            return json_decode($request->getBody()->getContents());
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criar Assinatura IUGU
     *
     * Cria uma Assinatura
     */
    public static function criarAssinatura($idCliente, $identificadorPlano = '', $dataExpiracao, $metodoDePagamento = 'bank_slip', $isCredito = false, $preco, $creditoAdiconal, $creditoMinimo, $subitems = null, $customerVariables = null)
    {
        try {
            
            if ($idCliente) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions', [
                    'form_params' => [
                        'plan_identifier' => $identificadorPlano, // Identificador do Plano. Só é enviado para assinaturas que não são credits_based
                        'customer_id' => $idCliente,
                        'expires_at' => ($dataExpiracao) ? $dataExpiracao : date('d/m/Y') + 3,
                        'only_on_charge_success' => true,
                        'ignore_due_email' => false,
                        'payable_with' => $metodoDePagamento,
                        'credits_based' => $isCredito, // É uma assinatura baseada em créditos? booleano
                        'price_cents' => $preco, // Preço em centavos da recarga para assinaturas baseadas em crédito
                        'credits_cycle' => $creditoAdiconal, // Quantidade de créditos adicionados a cada ciclo, só enviado para assinaturas credits_based
                        'credits_min' => $creditoMinimo, // Quantidade de créditos que ativa o ciclo, por ex: Efetuar cobrança cada vez que a assinatura tenha apenas 1 crédito sobrando. Esse 1 crédito é o credits_min
                        $subitems,
                        $customerVariables
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Ativar Assinatura IUGU
     *
     * Ativa uma Assinatura. Uma Fatura poderá ser gerada para o cliente
     */
    public static function ativarAssinatura($idAssinatura)
    {
        try {
            
            if ($idAssinatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/activate');
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Suspender Assinatura IUGU
     *
     * Suspende uma Assinatura
     */
    public static function suspenderAssinatura($idAssinatura)
    {
        try {
            if ($idAssinatura) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/suspend');
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterar Assinatura IUGU
     *
     * Altera os dados de uma Assinatura, quaisquer parâmetros não informados não serão alterados
     */
    public static function alterarAssinatura($idAssinatura, $identificadorDoPlano, $dataExpiracao, $metodoDePagamento, $ignoreEmail, $isCredito, $preco, $creditoAdiconal, $creditoMinimo, $suspender = false, $cobrar = true, $subitems = null)
    {
        try {
            
            if ($idAssinatura && $identificadorDoPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idAssinatura, [
                    'form_params' => [
                        'plan_identifier' => $identificadorDoPlano, // Identificador do Plano. Só é enviado para assinaturas que não são credits_based
                        'expires_at' => ($dataExpiracao) ? $dataExpiracao : date('d/m/Y') + 3,
                        'ignore_due_email' => $ignoreEmail,
                        'payable_with' => $metodoDePagamento,
                        'credits_based' => $isCredito, // É uma assinatura baseada em créditos? booleano
                        'price_cents' => $preco, // Preço em centavos da recarga para assinaturas baseadas em crédito
                        'credits_cycle' => $creditoAdiconal, // Quantidade de créditos adicionados a cada ciclo, só enviado para assinaturas credits_based
                        'credits_min' => $creditoMinimo, // Quantidade de créditos que ativa o ciclo, por ex: Efetuar cobrança cada vez que a assinatura tenha apenas 1 crédito sobrando. Esse 1 crédito é o credits_min
                        'suspended' => $suspender, // Assinatura suspensa? booleano
                        'skip_charge' => $cobrar, // Ignorar Cobrança? booleano
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
     * Simular Alteração de Plano de Assinatura IUGU
     *
     * Simula a alteração de plano de uma assinatura
     */
    public static function simularAlteracaoDePlanoAssitura($idAssinatura, $identificadorDoPlano)
    {
        try {
            if ($idAssinatura && $identificadorDoPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/change_plan_simulation/' . $identificadorDoPlano);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Alterar Plano da Assinatura IUGU
     *
     * Altera o Plano de uma Assinatura. Uma Fatura cobrando a mudança de plano poderá ser gerada para o cliente
     */
    public static function alterarPlanoDaAssinatura($idAssinatura, $identificadorDoPlano)
    {
        try {
            
            if ($idAssinatura && $identificadorDoPlano) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/change_plan/' . $identificadorDoPlano);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Adicionar Créditos a Assinatura IUGU
     *
     * Adiciona créditos a uma assinatura
     */
    public static function adiconarCreditoNaAssinatura($idAssinatura, $quantidade)
    {
        try {
            
            if ($idAssinatura && $quantidade) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/add_credits', [
                    'form_params' => [
                        'quantity' => $quantidade
                    ]
                ]);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remover Créditos da Assinatura
     *
     * Remover créditos a uma assinatura
     */
    public static function removerCreditoNaAssinatura($idAssinatura, $quantidade)
    {
        try {
            
            if ($idAssinatura && $quantidade) {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/subscriptions/' . $idAssinatura . '/remove_credits', [
                    'form_params' => [
                        'quantity' => $quantidade
                    ]
                ]);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remover Assinatura
     *
     * Remove uma Assinatura permanentemente
     */
    public static function removerAssinatura($idAssinatura)
    {
        try {
            
            if ($idAssinatura) {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/subscriptions/' . $idAssinatura);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Assinatura
     *
     * Retorna os dados de uma Assinatura
     */
    public static function buscarAssinatura($idAssinatura)
    {
        try {
            
            if ($idAssinatura) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/subscriptions/' . $idAssinatura);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Assinaturas
     *
     * Retorna uma lista com todas as assinaturas em sua conta ordenadas pela data de Criação, sendo a primeira a que foi
     * criada mais recentemente. O campo totalItems contém sempre a quantidade de assinaturas cadastradas, independente
     * dos parâmetros de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de items.
     */
    public static function listarAssinatura()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/subscriptions');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Transferir Valor IUGU
     *
     * Transfere um determinado valor de sua conta para a conta destino
     */
    public static function transferirValor($idConta, $valor, $customVariables = null)
    {
        try {
            
            if ($idConta && $valor) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/transfers', [
                    'form_params' => [
                        'receiver_id' => $idConta,
                        'amount_cents' => $valor,
                        $customVariables
                    ]
                ]);
            }
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Buscar Transferência IUGU
     *
     * Retorna as informações de uma transferência de valores.
     */
    public static function buscarTransferencia($idTranferencia)
    {
        try {
            if ($idTranferencia) {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/transfers/' . $idTranferencia);
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Listar Transferências IUGU
     *
     * Retorna uma lista com todas as transferências efetuadas.
     */
    public static function listarTransferencia()
    {
        try {
            $client = new Client(self::getHeaders());
            $request = $client->get('https://api.iugu.com/v1/transfers');
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Criar subconta IUGU
     *
     * Permite a criação de subcontas (contas de pagamento) para contas com permissão de marketplace ou parceiro de negócios
     */
    public static function criarSubconta($name, $commissionPercent)
    {
        try {
            if ($name && $commissionPercent) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/marketplace/create_account', [
                    'form_params' => [
                        'name' => $name,
                        'commission_percent' => $commissionPercent
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Enviar verificação de subconta IUGU
     *
     * Permite enviar documentos para verificação de subcontas. Todas as subcontas devem ter sua documentação verificada para emitir faturas no modo de produção
     */
    public static function enviarVerificacaoDeSubconta($idAccount, Debets $debets, Wallets $Wallets, $file)
    {
        try {
            if ($idAccount && $Wallets && $file) {
                
                $fileBody = null;
                if ($file) {
                    $fileBody = [
                        'files' => [
                            'id' => ($debet->pgm_pagador_cnpj) ? $debet->pgm_pagador_cnpj : $debet->pgm_pagador_cpf,
                            'cpf' => $debet->pgm_pagador_cpf,
                            'activity' => $file
                        ]
                    ];
                }
                
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/accounts/' . $idAccount . '/request_verification', [
                    'form_params' => [
                        'data' => [
                            'price_range' => $Wallets->wal_title,
                            'physical_products' => false,
                            'business_type' => $Wallets->wal_title,
                            'person_type' => ($debet->pgm_pagador_cnpj) ? 'Pessoa Jurídica' : 'Pessoa Física',
                            'automatic_transfer' => $Wallets->wal_saque_automatico,
                            'cnpj' => $debet->pgm_pagador_cnpj,
                            'cpf' => $debet->pgm_pagador_cpf,
                            'company_name' => $debet->pgm_pagador_razao,
                            'name' => $debet->pgm_pagador_nome,
                            'address' => $debet->pgm_endereco_logradouro,
                            'cep' => $debet->pgm_endereco_cep,
                            'city' => $debet->pgm_endereco_cidade,
                            'state' => $debet->pgm_endereco_estado,
                            'telephone' => $debet->pgm_pagador_celular,
                            'resp_name' => $debet->pgm_pagador_razao,
                            'bank' => $Wallets->wal_banco,
                            'bank_ag' => $Wallets->wal_agencia,
                            'account_type' => $Wallets,
                            'bank_cc' => $Wallets->wal_conta
                        ],
                        $fileBody
                    ]
                ]);
                
                return $request;
            }
        } catch (\Exception $e) {
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
     * Set up parameters for a payment account
     */
    public static function setUpAccount(Debets $debets, Wallets $Wallets)
    {
        try {
            if ($divida && $Wallets) {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/accounts/configuration', [
                    'form_params' => [
                        'commission_percent' => $debet->pgm_comissao_taxa,
                        'auto_withdraw' => $Wallets->wal_saque_automatico,
                        'fines' => true,
                        'per_day_interest' => true,
                        'late_payment_fine' => $debet->pgm_comissao_fixo,
                        'auto_advance' => true,
                        'auto_advance_type' => 'days_after_payment',
                        'auto_advance_option' => 20, // Número de dias após o pagamento em que a antecipação será realizada
                        'bank_slip' => [
                            'active' => true,
                            'extra_due' => 3, // Dias de Vencimento Extras no Boleto
                            'reprint_extra_due' => 1 // Dias de Vencimento Extras na 2a Via do Boleto
                        ],
                        'credit_card' => [
                            'active' => true,
                            'soft_descriptor' => 3, // Descrição que apareça na Fatura do Cartão do Cliente
                            'installments' => true,
                            'max_installments' => $debet->pgm_parcelas,
                            'max_installments_without_interest' => $debet->pgm_parcelas_pagas,
                            'two_step_transaction' => false,
                            'installments_pass_interest' => true
                        ],
                        'payment_email_notification' => true,
                        'payment_email_notification_receiver' => $debet->pgm_pagador_email,
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
    public static function addBankDomicilio(Wallets $wallet, $documento)
    {
        try 
        {
            if ($wallets && $documento) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/bank_verification', [
                    'form_params' => [
                        'agency' => $wallet->wal_agencia,
                        'account' => $wallet->wal_conta,
                        'account_type' => 'cc', // Tipo da Conta ("cc" para Conta Corrente e "cp" para Conta Poupança)
                        'bank' => $carteira->wal_banco,
                        'automatic_validation' => tru,
                        'document' => $documento
                    
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
        try {
            $client = new Client(self::getHeaders());
            $request = $client->post('https://api.iugu.com/v1/bank_verification');
            return $request;
        } catch (\Exception $e) {
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
    public static function createToken($idAccount)
    {
        try 
        {
            if ($idAccount) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->post('https://api.iugu.com/v1/' . $idAccount . '/api_tokens', [
                    'form_params' => [
                        'api_type' => 'TEST', // altere conforme o ambiente ('TEST' = desenvolvimento e 'LIVE' = produção)
                        'description' => 'SmartClick' // Descrição do consumidor da API
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
                $request = $client->delete('https://api.iugu.com/v1/' . Parametros::CLIENTE_ID_IUGU . '/api_tokens/' . $idToken);
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
                $request = $client->get('https://api.iugu.com/v1/' . Parametros::CLIENTE_ID_IUGU . '/api_tokens');
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
    public static function listarEventosDisponiveis()
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
     * Create Hooks IUGU
     *
     * Create a Hooks
     */
    public static function createKitten($event, $url, $authorization)
    {
        try {
            if ($event && $url && $authorization) {
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
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Change Hooks IUGU
     *
     * Change a Hooks
     */
    public static function changeKitten($idHooks, $event, $url, $authorization)
    {
        try 
        {
            if ($idHooks && $event && $url && $authorization) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/web_hooks/' . $idHooks, [
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
     * Remover Hooks IUGU
     *
     * Remove a Hooks
     */
    public static function removHooks($idHooks)
    {
        try 
        {
            if ($idHooks) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->delete('https://api.iugu.com/v1/web_hooks/' . $idHooks);
                return $request;
            }
        } 
        catch (\Exception $e) 
        {
            return $e->getMessage();
        }
    }

    /**
     * Search Hooks IUGU
     *
     * Search a Hooks
     */
    public static function searchKitten($idHooks)
    {
        try 
        {
            if ($idHooks) 
            {
                $client = new Client(self::getHeaders());
                $request = $client->get('https://api.iugu.com/v1/web_hooks/' . $idHooks);
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
    public static function listKitten()
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
     * Retorna lista de emails disponíveis para personalização
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
        try {
            if ($idContestation && $files) {
                $body = array();
                if (is_array($files)) {
                    foreach ($files as $key => $file) {
                        $body['file' . $key] = $file;
                    }
                }
                
                $client = new Client(self::getHeaders());
                $request = $client->put('https://api.iugu.com/v1/chargebacks/' . $idContestation . '/contest', $body);
                
                return $request;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Obey Contestação IUGU
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
    public static function getFeatures($debet, $identifier, $value)
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
     * Get Desconto de pagamento - Configuração do desconto a ser aplicado
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
     * Criar Pagador IUGU
     */
    private static function getPayer($debet)
    {
        return [
            "cpf_cnpj" => ($debet->pgm_pagador_cpf) ? $debet->pgm_pagador_cpf : $debet->pgm_pagador_cnpj,
            "name" => $debet->pgm_pagador_nome,
            "phone_prefix" => substr($debet->pgm_pagador_celular, 0, 2),
            "phone" => substr($debet->pgm_pagador_celular, 2),
            "email" => $debet->pgm_pagador_email,
            "address" => self::getPayerAddress($divida)
        ];
    }

    /**
     * Criar Endereco do Pagador IUGU
     */
    private static function getPayerAddress($debet)
    {
        return [
            "street" => $debet->pgm_endereco_logradouro,
            "number" => $debet->pgm_endereco_numero,
            "district" => $debet->pgm_endereco_bairro,
            "city" => $debet->pgm_endereco_cidade,
            "state" => $debet->pgm_endereco_estado,
            "complement" => $debet->pgm_endereco_complemento
        ];
    }

    /**
     * Get Headers
     */
    private static function getHeaders()
    {
        return [
            'headers' => [
                'Authorization' => 'Basic ' . Parametros::getTokenIugu(),
                'Content-Type' => 'application/json'
            ]
        ];
    }
}


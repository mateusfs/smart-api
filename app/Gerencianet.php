<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Gerencianet\Exception\GerencianetException;
use Carbon\Carbon;

class Gerencianet extends Model
{

    /**
     * Criar Transação GenreciaNet
     *
     * Criar Transação pelo GerenciaNet
     */
    public static function criarTransacao(Dividas $divida)
    {
        try {
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($divida));
            
            return $charge;
        } catch (GerencianetException $e) {
            return $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Atualizar Transações GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Atualizar Transações"
     */
    public static function atualizarTransacao($idTransacao, $url)
    {
        try {
            $params = [
                'id' => $idTransacao
            ];
            
            $body = [
                'custom_id' => Parametros::CLIENTE_ID_GERENCIA_NET, // associar transação Gerencianet com seu identificador próprio
                'notification_url' => $url // url de notificação
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
     * Detalhar Transações GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Detalhar Transações"
     */
    public static function detalharTransacoes($idTransacao)
    {
        try {
            
            $params = [
                'id' => $idTransacao
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
     * Cancelar Transações GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Cancelar Transações"
     */
    public static function cancelarTransacao($idTransacao)
    {
        try {
            $params = [
                'id' => $idTransacao
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
     * Criando assinaturas
     *
     * Você está em: "Assinaturas (Recorrência) > Criando assinaturas"
     */
    public static function criarAssinatura($nome, $intervalo = 1, $repeats = null)
    {
        try {
            $body = [
                'name' => $nome, // nome do plano de assinatura
                'interval' => $intervalo, // periodicidade da cobrança (em meses) - informe 1 para assinatura mensal
                'repeats' => $repeats // número de vezes que a cobrança deve ser gerada (padrão: null, que significa que a cobrança é gerada por tempo indeterminado ou até que o plano seja cancelado)
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
     * Crie inscrições (assinaturas) para vincular ao plano
     */
    public static function criarInscricaoAssinatura($idPlano, $nome, $quantidade, $valor)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou serviço
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (1000 = R$ 10,00)
            ];
            
            $body = [
                'items' => [
                    $item
                ]
            ];
            
            $params = [
                'id' => $idPlano
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
     * Alterando notification_url e/ou custom_id de assinaturas
     */
    public static function alterarAssinatura($idAssinatura, $url, $isTransacao)
    {
        try {
            
            $$params = [
                'id' => $idAssinatura
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
     * Defienir a forma de pagamento da assinatura e os dados do cliente
     */
    public static function pagarAssinatura($idAssinatura, $nome, $cpf, $celular, $vencimento = 5)
    {
        try {
            
            $params = [
                'id' => $idAssinatura
            ];
            
            $customer = [
                'name' => $nome,
                'cpf' => $cpf,
                'phone_number' => $celular
            ];
            
            $current = Carbon::now();
            $vencimento = $current->addDays($vencimento);
            
            $body = [
                'payment' => [
                    'banking_billet' => [
                        'expire_at' => $vencimento->format('Y-m-d'),
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
     * Listar os planos de assinatura existentes
     */
    public static function listarAssinatura($limit, $offset)
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
     * Detalhar informações de assinaturas
     *
     * Você está em: "Outros Recursos da API > Detalhar Transações"
     */
    public static function detalharAssinatura($idAssinatura)
    {
        try {
            
            $params = [
                'id' => $idAssinatura
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
     * Cancela um plano de assinatura
     */
    public static function deletarAssinatura($idAssinatura)
    {
        try {
            
            $params = [
                'id' => $idAssinatura
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
     * Cancelar assinaturas ativas em um plano
     */
    public static function cancelarAssinaturas($idAssinatura)
    {
        try {
            
            $params = [
                'id' => $idAssinatura
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
     * Criando carnês
     *
     * Você está em: "Carnês > Criando carnês"
     */
    public static function criarCarne(Dividas $divida, $nome, $quantidade, $valor, $vencimento = 5, $repeats = 5)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou serviço
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (1000 = R$ 10,00)
            ];
            
            $customer = [
                'name' => $divida->pgm_pagador_nome,
                'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                'phone_number' => $divida->pgm_pagador_celular
            ];
            
            $current = Carbon::now();
            $vencimento = $current->addDays($vencimento);
            
            $body = [
                'items' => [
                    $item
                ],
                'customer' => $customer,
                'expire_at' => $vencimento->format('Y-m-d'), // data de vencimento da primeira parcela do carnê
                'repeats' => $repeats, // número de parcelas do carnê
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
     * Retorna informações sobre um carnê criado
     *
     * Você está em: "Carnês > Criando carnês"
     */
    public static function buscarCarne($idCarne)
    {
        try {
            
            $params = [
                'id' => $idCarne
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
     * Alterando notification_url e/ou custom_id de carnês
     */
    public static function aleterarCarne($idCarne, $idTransacao, $url)
    {
        try {
            
            $params = [
                'id' => $idCarne
            ];
            
            $body = [
                'custom_id' => $idTransacao,
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
     * Alterando notification_url e/ou custom_id de carnês
     */
    public static function alterarVencimentoCarne($idCarne, $parcela, $vencimento = 1)
    {
        try {
            
            $params = [
                'id' => $idCarne,
                'parcel' => $parcela
            ];
            
            $current = Carbon::now();
            $vencimento = $current->addDays($vencimento);
            
            $body = [
                'expire_at' => $vencimento->format('Y-m-d')
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
     * Cancelar um determinado carnê
     */
    public static function cancelarCarne($idCarne, $vencimento = 1)
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
     * Cancelar parcela específica de um carnê existente
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
     * Reenviar carnê por email
     */
    public static function reenviarCarnePorEmail($idCarne, $email)
    {
        try {
            
            $params = [
                'id' => $idCarne
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
     * Reenviar parcela específica de carnê por email
     */
    public static function reenviarParcelaPorEmail($idCarne, $parcela, $email)
    {
        try {
            
            $params = [
                'id' => $idCarne,
                'parcel' => $parcela
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
     * Acrescentar informações ao histórico do carnê
     */
    public static function adicionarInformacoesAoCarne($idCarne, $descricao)
    {
        try {
            
            $params = [
                'id' => $idCarne
            ];
            
            $body = [
                'description' => $descricao
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
     * Definindo a URL para recebimento de notificações
     */
    public static function defenirMetadata($nome, $quantidade, $valor, $url)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou serviço
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
     * Consultando detalhes de uma notificação
     */
    public static function consultarNotificacao($token)
    {
        try {
            
            $params = [
                'token' => $token
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
     * Emetir Boleto GenreciaNet
     *
     * Criar um boleto em GerenciaNet
     */
    public static function emetirBoleto(Dividas $divida, $vencimento = 5)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($divida));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $customer = [
                    'name' => $divida->pgm_pagador_nome,
                    'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                    'phone_number' => $divida->pgm_pagador_celular
                ];
                
                $current = Carbon::now();
                $vencimento = $current->addDays($vencimento);
                
                $bankingBillet = [
                    'expire_at' => $vencimento->format('d/m/Y H:i:s'),
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
     * Pagar com Pessoa Jurídica GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Pagar com Pessoa Jurídica"
     */
    public static function emetirBoletoPessoaJuridica(Dividas $divida, $vencimento = 5)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($divida));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $juridical_data = [
                    'corporate_name' => $divida->pgm_pagador_razao,
                    'cnpj' => $divida->pgm_pagador_cnpj
                ];
                
                $customer = [
                    'name' => $divida->pgm_pagador_nome,
                    'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                    'phone_number' => $divida->pgm_pagador_celular,
                    'juridical_person' => $juridical_data
                ];
                
                $current = Carbon::now();
                $vencimento = $current->addDays($vencimento);
                
                $bankingBillet = [
                    'expire_at' => $vencimento->format('d/m/Y H:i:s'),
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
     * Definir Endereços GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Definir Endereços"
     */
    public static function definirEnderecoDoBoleto($idTrasacao, Dividas $divida, $paymentToken)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            
            $params = [
                'id' => $idTrasacao
            ];
            
            $customer = [
                'name' => $divida->pgm_pagador_nome,
                'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                'phone_number' => $divida->pgm_pagador_celular
            ];
            
            $billingAddress = [
                'street' => $divida->pgm_endereco_logradouro,
                'number' => $divida->pgm_endereco_numero,
                'neighborhood' => $divida->pgm_endereco_bairro,
                'zipcode' => $divida->pgm_endereco_cep,
                'city' => $divida->pgm_endereco_cidade,
                'state' => $divida->pgm_endereco_estado
            ];
            
            $creditCard = [
                'installments' => $divida->pgm_parcelas, // número de parcelas em que o pagamento deve ser dividido
                'billing_address' => $billingAddress,
                'payment_token' => $paymentToken,
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
     * Pagar Cartão GenreciaNet
     *
     * Pagar Cartão pelo GerenciaNet
     */
    public static function pagarCartao(Dividas $divida)
    {
        try {
            
            $api = new Gerencianet(self::getOptions());
            $charge = $api->createCharge([], self::getBody($divida));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                
                $customer = [
                    'name' => $divida->pgm_pagador_razao,
                    'cpf' => $divida->pgm_pagador_cpf,
                    'phone_number' => $divida->pgm_pagador_celular,
                    'email' => $divida->pgm_pagador_email,
                    'birth' => $divida->pgm_pagador_nascimento
                ];
                
                $billingAddress = [
                    'street' => $divida->pgm_endereco_logradouro,
                    'number' => $divida->pgm_endereco_numero,
                    'neighborhood' => $divida->pgm_endereco_bairro,
                    'zipcode' => $divida->pgm_endereco_cep,
                    'city' => $divida->pgm_endereco_cidade,
                    'state' => $divida->pgm_endereco_estado // Verificar o estado do cliente
                ];
                
                $creditCard = [
                    'installments' => $divida->pgm_cartao_codigo, // Verificar installments do cliente
                    'billing_address' => $billingAddress,
                    'payment_token' => $divida->pgm_intermediario_code, // Verificar paymentToken do cliente
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
     * Listar Parcelas Cartão GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Listar Parcelas Cartão"
     */
    public static function listarParcelasCartao($total, $bandeira)
    {
        try {
            
            $params = [
                'total' => $total,
                'brand' => $bandeira
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
    public static function pagarMarketplace(Dividas $divida, $idUsuario, $porcentagem, $nomeProduto, $quantidade, $valor, $token)
    {
        try {
            
            $repasses = [
                [
                    'payee_code' => $idUsuario, // identificador da conta Gerencianet (repasse 1)
                    'percentage' => $porcentagem // porcentagem de repasse (2500 = 25%)
                ]
            ];
            
            $items = [
                [
                    'name' => $nomeProduto,
                    'amount' => $quantidade,
                    'value' => $valor,
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
                    'name' => $divida->pgm_pagador_nome,
                    'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                    'phone_number' => $divida->pgm_pagador_celular,
                    'email' => $divida->pgm_pagador_email,
                    'birth' => $divida->pgm_pagador_nascimento
                ];
                
                $billingAddress = [
                    'street' => $divida->pgm_endereco_logradouro,
                    'number' => $divida->pgm_endereco_numero,
                    'neighborhood' => $divida->pgm_endereco_bairro,
                    'zipcode' => $divida->pgm_endereco_cep,
                    'city' => $divida->pgm_endereco_cidade,
                    'state' => $divida->pgm_endereco_estado
                ];
                
                $creditCard = [
                    'installments' => (int) $_POST["installments"],
                    'billing_address' => $billingAddress,
                    'payment_token' => $token,
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
     * Dividindo recebimentos GenreciaNet
     *
     * Você está em: "Marketplace > Dividindo recebimentos"
     */
    public static function dividirRecebimentoMarketplace(Dividas $divida, $repasses = array(), $quantidade, $valor, $token)
    {
        try {
            
            $items = [
                [
                    'name' => $nomeProduto,
                    'amount' => $quantidade,
                    'value' => $valor,
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
     * Criando link de pagamento GenreciaNet
     *
     * Você está em: "Link de Pagamento > Criando link de pagamento"
     */
    public static function emetirLink($nomeProduto, $quantidade, $valor, $menssagem, $vencimento, $entregarEmail = true, $metodoPagamento)
    {
        try {
            
            $items = [
                [
                    'name' => $nomeProduto,
                    'amount' => $quantidade,
                    'value' => $valor
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
                    'message' => $menssagem,
                    'expire_at' => $vencimento,
                    // 'request_delivery_address' => (boolean) $_POST["request"],
                    'request_delivery_address' => $entregarEmail,
                    'payment_method' => $metodoPagamento
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
     * Retorma repasses
     *
     */
    public static function getRepasses($idUsuario1, $porcentagem1, $idUsuario2, $porcentagem2)
    {
        $repass_1 = [
            'payee_code' => $idUsuario1, // identificador da conta Gerencianet (repasse 1)
            'percentage' => $porcentagem1 // porcentagem de repasse (2500 = 25%)
        ];
        
        $repass_2 = [
            'payee_code' => $idUsuario2, // identificador da conta Gerencianet (repasse 2)
            'percentage' => $porcentagem2 // porcentagem de repasse (1500 = 15%)
        ];
        
        $repasses = [
            $repass_1,
            $repass_2
        ];
        
        return $repasses;
    }

    /**
     * Detalhar informações de carnê
     *
     * Você está em: "Outros Recursos da API > Detalhar Transações"
     */
    public static function detalharCarne($idCarne)
    {
        try {
            
            $params = [
                'id' => $idCarne
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
     * Reenviando um boleto bancário por email GenreciaNet
     *
     * Você está em: "Outros Recursos da API > Reenvio de Transações"
     */
    public static function reenviarEmailBancario($idTransacao, $email)
    {
        try {
            
            $params = [
                'id' => $idTransacao
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
            'client_id' => Parametros::getClienteIdGerenciaNet(),
            'client_secret' => Parametros::getSecretGerenciaNet(),
            'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = produção)
        ];
    }

    /**
     * Get Body
     */
    private static function getBody(Dividas $divida)
    {
        return [
            'items' => [
                [
                    'name' => $divida->pgm_pagador_razao,
                    'amount' => 1,
                    'value' => $divida->pgm_valor
                ]
            ]
        ];
    }
}

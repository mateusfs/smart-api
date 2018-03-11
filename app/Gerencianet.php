<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Gerencianet\Exception\GerencianetException;
use Carbon\Carbon;

class Gerencianet extends Model
{

    /**
     * Criar Transa��o GenreciaNet
     *
     * Criar Transa��o pelo GerenciaNet
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
     * Atualizar Transa��es GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Atualizar Transa��es"
     */
    public static function atualizarTransacao($idTransacao, $url)
    {
        try {
            $params = [
                'id' => $idTransacao
            ];
            
            $body = [
                'custom_id' => Parametros::CLIENTE_ID_GERENCIA_NET, // associar transa��o Gerencianet com seu identificador pr�prio
                'notification_url' => $url // url de notifica��o
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
     * Detalhar Transa��es GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Detalhar Transa��es"
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
     * Cancelar Transa��es GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Cancelar Transa��es"
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
     * Voc� est� em: "Assinaturas (Recorr�ncia) > Criando assinaturas"
     */
    public static function criarAssinatura($nome, $intervalo = 1, $repeats = null)
    {
        try {
            $body = [
                'name' => $nome, // nome do plano de assinatura
                'interval' => $intervalo, // periodicidade da cobran�a (em meses) - informe 1 para assinatura mensal
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
     * Crie inscri��es (assinaturas) para vincular ao plano
     *
     */
    public static function criarInscricaoAssinatura($idPlano, $nome, $quantidade, $valor)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou servi�o
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (1000 = R$ 10,00)
            ];
            
            $body  =  ['items' => [$item]];
            
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
     *
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
     *
     */
    public static function pagarAssinatura($idAssinatura, $nome, $cpf, $celular, $vencimento = 5)
    {
        try {
            
            $params = ['id' => $idAssinatura];
            
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
     *
     */
    public static function listarAssinatura($limit, $offset)
    {
        try {
            
            $params = ['limit' => $limit, 'offset' => $offset];
            
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
     * Detalhar informa��es de assinaturas
     *
     * Voc� est� em: "Outros Recursos da API > Detalhar Transa��es"
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
     *
     */
    public static function deletarAssinatura($idAssinatura)
    {
        try {
            
            $params = ['id' => $idAssinatura];
            
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
     *
     */
    public static function cancelarAssinaturas($idAssinatura)
    {
        try {
            
            $params = ['id' => $idAssinatura];
            
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
     *
     */
    public static function criarCarne(Dividas $divida, $nome, $quantidade, $valor, $vencimento = 5, $repeats = 5)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou servi�o
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
                'items' => [$item],
                'customer' => $customer,
                'expire_at' => $vencimento->format('Y-m-d'), // data de vencimento da primeira parcela do carn�
                'repeats' => $repeats, // n�mero de parcelas do carn�
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
     * Retorna informa��es sobre um carn� criado
     *
     * Voc� est� em: "Carn�s > Criando carn�s"
     *
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
     * 
     * Alterando notification_url e/ou custom_id de carn�s
     *
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
     *
     * Alterando notification_url e/ou custom_id de carn�s
     *
     */
    public static function alterarVencimentoCarne($idCarne, $parcela, $vencimento = 1)
    {
        try {
            
            $params = ['id' => $idCarne, 'parcel' => $parcela];
            
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
     *
     * Cancelar um determinado carn�
     *
     */
    public static function cancelarCarne($idCarne, $vencimento = 1)
    {
        try {
            
            $params = ['id' => $idCarne];
            
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
     *
     * Cancelar parcela espec�fica de um carn� existente
     *
     */
    public static function cancelarParcelaCarne($idCarne, $parcela)
    {
        try {
            
            $params = ['id' => $idCarne, 'parcel' => $parcela];
            
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
     *
     * Reenviar carn� por email
     *
     */
    public static function reenviarCarnePorEmail($idCarne, $email)
    {
        try {
            
            $params = ['id' => $idCarne];
            
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
     *
     * Reenviar parcela espec�fica de carn� por email
     *
     */
    public static function reenviarParcelaPorEmail($idCarne, $parcela, $email)
    {
        try {
            
            $params = ['id' => $idCarne, 'parcel' => $parcela];
            
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
     *
     * Acrescentar informa��es ao hist�rico do carn�
     *
     */
    public static function adicionarInformacoesAoCarne($idCarne, $descricao)
    {
        try {
            
            $params = ['id' => $idCarne];
            
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
     *
     * Definindo a URL para recebimento de notifica��es
     *
     */
    public static function defenirMetadata($nome, $quantidade, $valor, $url)
    {
        try {
            
            $item = [
                'name' => $nome, // nome do item, produto ou servi�o
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (1000 = R$ 10,00)
            ];
            
            $metadata = array('notification_url' => $url);
            
            $body = [
                'items' => [$item],
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
     *
     * Consultando detalhes de uma notifica��o
     *
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
     * Pagar com Pessoa Jur�dica GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Pagar com Pessoa Jur�dica"
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
     * Definir Endere�os GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Definir Endere�os"
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
                'installments' => $divida->pgm_parcelas, // n�mero de parcelas em que o pagamento deve ser dividido
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
     * Pagar Cart�o GenreciaNet
     *
     * Pagar Cart�o pelo GerenciaNet
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
                    'state' => 'Santa Caratina' // Verificar o estado do cliente
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
     * Listar Parcelas Cart�o GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Listar Parcelas Cart�o"
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
     * Detalhar informa��es de carn�
     *
     * Voc� est� em: "Outros Recursos da API > Detalhar Transa��es"
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
     * Reenviando um boleto banc�rio por email GenreciaNet
     *
     * Voc� est� em: "Outros Recursos da API > Reenvio de Transa��es"
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
            'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = produ��o)
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

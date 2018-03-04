<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Gerencianet\Exception\GerencianetException;
use Carbon\Carbon;

class Gerencianet extends Model
{

    public $clientId = "";

    public $clientSecret = "";

    /**
     * Criar Transação GenreciaNet
     *
     * Criar Transação pelo GerenciaNet
     */
    public function criarTransacao($nome, $quantidade, $valor)
    {
        
        $body  =  [
            'items' => [
                'name' => $nome, // nome do item, produto ou serviço
                'amount' => $quantidade, // quantidade
                'value' => $valor // valor (2000 = R$ 20,00)
            ]
        ];
        
        try {
            $api = new Gerencianet($this->getOptions());
            $charge = $api->createCharge([], $body);
            
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
    public function emetirBoleto(Dividas $divida)
    {
        try {
            
            $api = new Gerencianet($this->getOptions());
            $charge = $api->createCharge([], $this->getBody($divida));
            
            if ($charge["code"] == 200) {
                
                $params = [
                    'id' => $charge["data"]["charge_id"]
                ];
                $customer = [
                    'name' => $divida->pgm_pagador_razao,
                    'cpf' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
                    'phone_number' => $divida->pgm_pagador_celular
                ];
                
                $current = Carbon::now();
                $vencimento = $current->addDays(5);
                
                $bankingBillet = [
                    'expire_at' => $vencimento->format('d/m/Y H:i:s'),
                    'customer' => $customer
                ];
                
                $body = [
                    'payment' => [
                        'banking_billet' => $bankingBillet
                    ]
                ];
                
                $api = new Gerencianet($this->getOptions());
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
     * Pagar Cartão GenreciaNet
     *
     * Pagar Cartão pelo GerenciaNet
     */
    public function pagarCartao(Dividas $divida)
    {
        try {
            
            $api = new Gerencianet($this->getOptions());
            $charge = $api->createCharge([], $this->getBody($divida));
            
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
                
                $api = new Gerencianet($this->getOptions());
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
     * Get Options
     */
    public function getOptions()
    {
        return [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'sandbox' => true // altere conforme o ambiente (true = desenvolvimento e false = produção)
        ];
    }

    /**
     * Get Body
     */
    public function getBody(Dividas $divida)
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

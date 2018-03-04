<?php
namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Iugu extends Model
{

    /**
     * Pedido de Saque IUGU
     *
     * Faz um pedido de Saque de um valor
     */
    public static function saque($id, $valor)
    {
        $client = new Client();
        $request = $client->post('https://api.iugu.com/v1/accounts/' . self::clientId . '/request_withdraw', [
            'body' => [
                'id' => $id,
                'amount' => $valor
            ]
        ]);
        
        return $client;
    }

    /**
     * Criar Forma de Pagamento IUGU
     *
     * Cria uma Forma de Pagamento de Cliente.
     */
    public static function criarFormaPagamento($idCliente, $description)
    {
        $client = new Client(self::getHeaders());
        $request = $client->post('https://api.iugu.com/v1/accounts/' . $idCliente . '/request_withdraw', [
            'body' => [
                'description' => $description,
                'token' => self::getToken(),
                'set_as_default' => false
            ]
        ]);
        
        return $client;
    }
    
    
    /**
     * Cobrança Direta IUGU
     *
     * Cobrança simples via boleto ou cartão de crédito.
     */
    public static function cobrancaDireta(Dividas $divida)
    {
        
        dd(self::getToken());
        
        $clienteIugu = self::buscarCliente(Parametros::getClienteIdIugu());
        
        dd($clienteIugu);
        
        $formPagmaneto = self::criarFormaPagamento($idCliente, $description);
        
        
        $client = new Client(self::getHeaders());
        $request = $client->post('https://api.iugu.com/v1/charge', [
            'body' => [
                'method' => 'bank_slip',
                'customer_payment_method_id' => $formPagmaneto['id'],
                'restrict_payment_method' => true,
                'customer_id' => '',
                'invoice_id' => '',
                'email' => '',
                'months' => '',
                'discount_cents' => '',
                'bank_slip_extra_days' => '',
                'keep_dunning' => '',
                'items' => [
                    'description' => '',
                    'quantity' => 0,
                    'price_cents' => 0,
                ],
                'payer' => getPayer($clienteIugu)
            ]
        ]);
        
        return $client;
    }
        
    /**
     * Buscar Cliente IUGU
     *
     * Retorna os dados de um cliente
     */
    public static function buscarCliente($idCliente)
    {
        $client = new Client(self::getHeaders());
        $request = $client->get('https://api.iugu.com/v1/customers/'.$idCliente);
        return $client;
    }

    /**
     * Transferir Valor IUGU
     *
     * Transfere um determinado valor de sua conta para a conta destino.
     */
    public static function transferirValor($receiver_id, $amount_cents, $name, $value)
    {
        $client = new Client(self::getHeaders());
        $request = $client->post('https://api.iugu.com/v1/transfers', [
            'body' => [
                'receiver_id' => $receiver_id,
                'amount_cents' => $amount_cents,
                'custom_variables' => [
                    'name' => $name,
                    'value' => $value
                ]
            ]
        ]);
        
        return $client;
    }

    /**
     * Buscar Transferência IUGU
     *
     * Retorna as informações de uma transferência de valores.
     */
    public static function buscaTransferencia($id)
    {
        $client = new Client(self::getHeaders());
        $request = $client->get('https://api.iugu.com/v1/transfers/' . $id);
        return $client;
    }

    /**
     * Disputar Contestação IUGU
     *
     * Abre uma disputa sobre a contestação.
     */
    public static function disputarContestacao($id, $files)
    {
        $body = array();
        if (is_array($files)) {
            foreach ($files as $key => $file) {
                $body['file' . $key] = $file;
            }
        }
        
        $client = new Client(self::getHeaders());
        $request = $client->put('https://api.iugu.com/v1/chargebacks/' . $id . '/contest', [
            'body' => $body
        ]);
        
        return $client;
    }

    /**
     * Buscar Contestação IUGU
     *
     * Retorna as informações de uma contestação.
     */
    public static function buscarContestacao($id)
    {
        $client = new Client(self::getHeaders());
        $request = $client->get('https://api.iugu.com/v1/chargebacks/' . $id);
        return $client;
    }

    /**
     * Acatar Contestação IUGU
     *
     * Acata a solicitação de contestação.
     */
    public static function aceitarContestacao($id)
    {
        $client = new Client(self::getHeaders());
        $request = $client->put('https://api.iugu.com/v1/chargebacks/' . $id . '/accept');
        return $client;
    }

    /**
     * Extrato Financeiro IUGU
     *
     * Retorna o extrato financeiro de uma conta.
     */
    public static function extratoFinanceiro()
    {
        $client = new Client(self::getHeaders());
        $request = $client->get('https://api.iugu.com/v1/accounts/financial');
        return $client;
    }

    /**
     * Extrato de Faturas IUGU
     *
     * Retorna o extrato de faturas de uma conta
     */
    public static function extratoFaturas()
    {
        $client = new Client(self::getHeaders());
        $request = $client->get('https://api.iugu.com/v1/accounts/invoices');
        return $client;
    }
    
    /**
     * Criar Pagador IUGU
     *
     */
    private static function getPayer($clienteIugu){
        
        $payer = new PayerIugu();
        $payer->cpf_cnpj = $clienteIugu['cpf_cnpj'];
        $payer->name = $clienteIugu['cpf_cnpj'];
        $payer->phone_prefix = $clienteIugu['cpf_cnpj'];
        $payer->phone = $clienteIugu['cpf_cnpj'];
        $payer->email = $clienteIugu['cpf_cnpj'];
        $payer->address = self::getPayerAddress($clienteIugu);
        
        return $payer;
    }
    
    /**
     * Criar Endereco do Pagador IUGU
     *
     */
    private static function getPayerAddress($clienteIugu){
        
        $address = new PayerAddressIugu();
        $address->street = $clienteIugu['street'];
        $address->number = $clienteIugu['number'];
        $address->district = $clienteIugu['district'];
        $address->city = $clienteIugu['city'];
        $address->state = $clienteIugu['state'];
        $address->zip_code = $clienteIugu['zip_code'];
        $address->complement = $clienteIugu['complement'];
        
        return $address;
    }
    
    
    

    /**
     * Get Headers
     */
    private static function getHeaders()
    {
        return [
            'headers' => [
                'Authorization' => 'Basic ' . self::getToken()
            ]
        ];
    }

    /**
     * Get Options
     */
    private static function getToken()
    {
        if (! session('token_iugu')) {
            $client = new Client();

            $request = $client->post('https://api.iugu.com/v1/' . Parametros::getClienteIdIugu() . '/api_tokens', [
                'body' => [
                    'api_type' => 'TEST', // altere conforme o ambiente ('TEST' = desenvolvimento e 'LIVE' = produção)
                    'description' => 'SmartClick' // Descrição do consumidor da API
                ]
            ]);
            
            dd($request);
            if ($request['token']) {
                session('token_iugu', $request['token']);
            }
        }
        return session('token_iugu');
    }
}


<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;

class Iugu extends Model
{

    public $clientId = "";

    public $clientSecret = "";

    /**
     * Pedido de Saque IUGU
     *
     * Faz um pedido de Saque de um valor
     */
    public function saque($id, $valor)
    {
        $client = new Client();
        $request = $client->createRequest('POST', 'https://api.iugu.com/v1/accounts/' . $this->clientId . '/request_withdraw', [
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
    public function criarFormaPagamento($id, $description)
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('POST', 'https://api.iugu.com/v1/accounts/' . $this->clientId . '/request_withdraw', [
            'body' => [
                'customer_id' => $id,
                'description' => $description,
                'token' => $this->getToken(),
                'set_as_default' => false
            ]
        ]);
        
        return $client;
    }

    /**
     * Transferir Valor IUGU
     *
     * Transfere um determinado valor de sua conta para a conta destino.
     */
    public function transferirValor($receiver_id, $amount_cents, $name, $value)
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('POST', 'https://api.iugu.com/v1/transfers', [
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
    public function buscaTransferencia($id)
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('GET', 'https://api.iugu.com/v1/transfers/' . $id);
        return $client;
    }

    /**
     * Disputar Contestação IUGU
     *
     * Abre uma disputa sobre a contestação.
     */
    public function disputarContestacao($id, $files)
    {
        $body = array();
        if (is_array($files)) {
            foreach ($files as $key => $file) {
                $body['file' . $key] = $file;
            }
        }
        
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('PUT', 'https://api.iugu.com/v1/chargebacks/' . $id . '/contest', [
            'body' => $body
        ]);
        
        return $client;
    }

    /**
     * Buscar Contestação IUGU
     *
     * Retorna as informações de uma contestação.
     */
    public function aceitarContestacao($id)
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('GET', 'https://api.iugu.com/v1/chargebacks/' . $id);
        return $client;
    }

    /**
     * Acatar Contestação IUGU
     *
     * Acata a solicitação de contestação.
     */
    public function aceitarContestacao($id)
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('PUT', 'https://api.iugu.com/v1/chargebacks/' . $id . '/accept');
        return $client;
    }

    /**
     * Extrato Financeiro IUGU
     *
     * Retorna o extrato financeiro de uma conta.
     */
    public function extratoFinanceiro()
    {
        $client = new Client($this->getHeaders());
        $request = $client->createRequest('GET', 'https://api.iugu.com/v1/accounts/financial');
        return $client;
    }

    /**
     * Extrato de Faturas IUGU
     *
     * Retorna o extrato de faturas de uma conta
     */
    public function extratoFinanceiro()
    {
        $client = new Client($this->getHeaders());
        $client->header->add($parameter);
        $request = $client->createRequest('GET', 'https://api.iugu.com/v1/accounts/invoices');
        return $client;
    }

    /**
     * Get Headers
     */
    public function getHeaders()
    {
        return [
            'headers' => [
                'Authorization' => 'Basic ' . $this->getToken()
            ]
        ];
    }

    /**
     * Get Options
     */
    public function getToken()
    {
        if (! session('token_iugu')) {
            $client = new Client();
            $request = $client->createRequest('POST', 'https://api.iugu.com/v1/' . $this->clientId . '/api_tokens', [
                'body' => [
                    'api_type' => 'TEST', // altere conforme o ambiente ('TEST' = desenvolvimento e 'LIVE' = produção)
                    'description' => 'SmartClick' // Descrição do consumidor da API
                ]
            ]);
            
            if ($client['token']) {
                session('token_iugu', $client['token']);
            }
        }
        return session('token_iugu');
    }
}


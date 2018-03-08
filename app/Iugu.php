<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Iugu extends Model {
	
	/**
	 * Pedido de Saque IUGU
	 *
	 * Faz um pedido de Saque de um valor
	 */
	public static function saque($idClienteIugu, $valor) {
		try {
			$client = new Client ();
			$request = $client->post ( 'https://api.iugu.com/v1/accounts/' . $idClienteIugu . '/request_withdraw', [ 
					'form_params' => [ 
							'id' => $idClienteIugu,
							'amount' => $valor 
					] 
			] );
			
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Criar Forma de Pagamento IUGU
	 *
	 * Cria uma Forma de Pagamento de Cliente.
	 */
	public static function criarFormaPagamento($idClienteIugu) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->post ( 'https://api.iugu.com/v1/customers/' . $idClienteIugu . '/payment_methods', [ 
					'form_params' => [ 
							'description' => 'SmartClic',
							'token' => self::getToken (),
							'set_as_default' => false 
					] 
			] );
			
			return json_decode ( $request->getBody ()->getContents () );
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Cobrança Direta IUGU
	 *
	 * Cobrança simples via boleto ou cartão de crédito.
	 */
	public static function cobrancaDireta(Dividas $divida) {
		try {
			
			if ($divida) {
				$client = new Client ( self::getHeaders () );
				$request = $client->post ( 'https://api.iugu.com/v1/charge', [ 
						'form_params' => [ 
								'method' => 'bank_slip',
								'restrict_payment_method' => true,
								// 'customer_id' => $clienteIugu->id,
								// 'invoice_id' => $clienteIugu,
								'email' => $divida->pgm_pagador_email,
								'months' => $divida->pgm_parcelas,
								'discount_cents' => $divida->pgm_valor,
								// 'bank_slip_extra_days' => $divida,
								'keep_dunning' => true,
								// 'items' => [
								// 'description' => $divida->pgm_pagador_nome,
								// 'quantity' => 0,
								// 'price_cents' => 0
								// ],
								'payer' => self::getPayer ( $divida ) 
						] 
				] );
			}
			
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Buscar Cliente IUGU
	 *
	 * Retorna os dados de um cliente
	 */
	public static function buscarCliente($idClienteIugu) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->get ( 'https://api.iugu.com/v1/customers/' . $idClienteIugu );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Criar Cliente IUGU
	 *
	 * Cria um objeto cliente
	 */
	public static function criarCliente(Dividas $divida) {
		try {
			
			$client = new Client ( self::getHeaders () );
			
			$request = $client->post ( 'https://api.iugu.com/v1/customers', [ 
					'form_params' => [ 
							'email' => $divida->pgm_pagador_email,
							'name' => $divida->pgm_pagador_nome,
							'phone' => $divida->pgm_pagador_celular,
							'phone_prefix' => '47',
							'cpf_cnpj' => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
							'cc_emails' => $divida->pgm_pagador_email,
							'zip_code' => $divida->pgm_endereco_cep,
							'number' => $divida->pgm_endereco_numero,
							'street' => $divida->pgm_endereco_logradouro,
							'city' => $divida->pgm_endereco_cidade,
							'state' => 'SC',
							'district' => $divida->pgm_endereco_bairro,
							'complement' => $divida->pgm_endereco_complemento 
					] 
			] );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Transferir Valor IUGU
	 *
	 * Transfere um determinado valor de sua conta para a conta destino.
	 */
	public static function transferirValor($receiver_id, $amount_cents, $name, $value) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->post ( 'https://api.iugu.com/v1/transfers', [ 
					'form_params' => [ 
							'receiver_id' => $receiver_id,
							'amount_cents' => $amount_cents,
							'custom_variables' => [ 
									'name' => $name,
									'value' => $value 
							] 
					] 
			] );
			
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Buscar Transferência IUGU
	 *
	 * Retorna as informações de uma transferência de valores.
	 */
	public static function buscaTransferencia($id) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->get ( 'https://api.iugu.com/v1/transfers/' . $id );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Disputar Contestação IUGU
	 *
	 * Abre uma disputa sobre a contestação.
	 */
	public static function disputarContestacao($id, $files) {
		try {
			$body = array ();
			if (is_array ( $files )) {
				foreach ( $files as $key => $file ) {
					$body ['file' . $key] = $file;
				}
			}
			
			$client = new Client ( self::getHeaders () );
			$request = $client->put ( 'https://api.iugu.com/v1/chargebacks/' . $id . '/contest', $body );
			
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Buscar Contestação IUGU
	 *
	 * Retorna as informações de uma contestação.
	 */
	public static function buscarContestacao($id) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->get ( 'https://api.iugu.com/v1/chargebacks/' . $id );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Acatar Contestação IUGU
	 *
	 * Acata a solicitação de contestação.
	 */
	public static function aceitarContestacao($id) {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->put ( 'https://api.iugu.com/v1/chargebacks/' . $id . '/accept' );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Extrato Financeiro IUGU
	 *
	 * Retorna o extrato financeiro de uma conta.
	 */
	public static function extratoFinanceiro() {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->get ( 'https://api.iugu.com/v1/accounts/financial' );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Extrato de Faturas IUGU
	 *
	 * Retorna o extrato de faturas de uma conta
	 */
	public static function extratoFaturas() {
		try {
			$client = new Client ( self::getHeaders () );
			$request = $client->get ( 'https://api.iugu.com/v1/accounts/invoices' );
			return $request;
		} catch ( \Exception $e ) {
			return $e->getMessage ();
		}
	}
	
	/**
	 * Criar Pagador IUGU
	 */
	private static function getPayer($divida) {
		return [ 
				"cpf_cnpj" => ($divida->pgm_pagador_cpf) ? $divida->pgm_pagador_cpf : $divida->pgm_pagador_cnpj,
				"name" => $divida->pgm_pagador_nome,
				"phone_prefix" => substr ( $divida->pgm_pagador_celular, 0, 2 ),
				"phone" => substr ( $divida->pgm_pagador_celular, 2 ),
				"email" => $divida->pgm_pagador_email,
				"address" => self::getPayerAddress ( $divida ) 
		];
	}
	
	/**
	 * Criar Endereco do Pagador IUGU
	 */
	private static function getPayerAddress($divida) {
		return [ 
				"street" => $divida->pgm_endereco_logradouro,
				"number" => $divida->pgm_endereco_numero,
				"district" => $divida->pgm_endereco_bairro,
				"city" => $divida->pgm_endereco_cidade,
				"state" => 'SC', // $divida->pgm_endereco_estado,
				"zip_code" => $divida->pgm_endereco_cep,
				"complement" => $divida->pgm_endereco_complemento 
		];
	}
	
	/**
	 * Get Headers
	 */
	private static function getHeaders() {
		return [ 
				'headers' => [ 
						'Authorization' => 'Basic ' . Parametros::getTokenIugu (),
						'Content-Type' => 'application/json' 
				] 
		];
	}
	
	/**
	 * Get Options
	 */
	private static function getToken() {
		$client = new Client ();
		$request = $client->post ( 'https://api.iugu.com/v1/' . Parametros::CLIENTE_ID_IUGU . '/api_tokens', [ 
				'form_params' => [ 
						'api_type' => 'TEST', // altere conforme o ambiente ('TEST' = desenvolvimento e 'LIVE' = produção)
						'description' => 'SmartClick'  // Descrição do consumidor da API
				] 
		] );
		
		return $request;
	}
}


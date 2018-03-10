<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Iugu extends Model {
	
    /**
     * Criar Fatura IUGU
     *
     * Cria uma Fatura para um Cliente (Podendo ser um objeto cliente ou apenas um e-mail).
     */
    public static function criarFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices', [
                'form_params' => [
                    'email' => $divida->pgm_pagador_email,
                    'cc_emails' => $divida->pgm_pagador_email,
                    'due_date' => date('YY-M-D')+3,
                    'ensure_workday_due_date' => true,
                    'items' => [
                            'description' => $divida->pgm_pagador_nome,
                            'quantity' => 1,
                            'price_cents' => $divida->pgm_valor
                        ],
                    'return_url' => '',
                    'expired_url' => '',
                    'fines' => true,
                    'late_payment_fine' => $divida->pgm_comissao_taxa,
                    'per_day_interest' => $divida->pgm_valor,
                    'discount_cents' => '',
                    //'customer_id' => ($divida->pgm_id_cliente_iugu)?$divida->pgm_id_cliente_iugu:$divida->pgm_id_cliente_gerencia_net,
                    'ignore_due_email' => false,
                    //'subscription_id' => '',
                    'payable_with' => 'all',
                    //'credits' => '',
                    'logs' => [
                        'description' => 'Smart CLic',
                        'notes' => date('d/m/Y H:i:s')
                     ],
                    'custom_variables' => [
                        'name' => $divida->pgm_pagador_nome,
                        'value' => $divida->pgm_valor
                    ],
                    'early_payment_discount' => false,
                    //'early_payment_discounts' => '',
                    'payer' => self::getPayer ( $divida ) 
                ]
            ]);
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Capturar Fatura IUGU
     *
     * Captura uma fatura com estado "Em Análise" / "in_analysis".
     */
    public static function capturarFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu.'/capture', [
                'form_params' => [
                    'id' => $divida->pgm_id_fatura_iugu
                ]
            ]);
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    /**
     * Reembolsar Fatura IUGU
     *
     * Efetua o reembolso de uma Fatura. Somente alguns meios de pagamento permitem o reembolso, como por exemplo o 
     * Cartão de Crédito. Após o reembolso, a Fatura fica com o status de "reembolsada" / "refunded".
     * 
     */
    public static function reembolsarFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu.'/refund', [
                'form_params' => [
                    'id' => $divida->pgm_id_fatura_iugu
                ]
            ]);
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Cancelar Fatura IUGU
     *
     * Cancela uma Fatura
     *
     */
    public static function cancelarFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu.'/cancel', [
                'form_params' => [
                    'id' => $divida->pgm_id_fatura_iugu
                ]
            ]);
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Gerar 2ª via de fatura IUGU
     *
     * Gera a segunda via de uma fatura com o status "pendente". A fatura atual é cancelada e uma nova é criada com o mesmo status.
     *
     */
    public static function gerarSegundaViaFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu.'/duplicate', [
                'form_params' => [
                    'id' => $idFatura,
                    'due_date' => date('YY-M-D'),
                    'items' => [
                        'description' => $divida->pgm_pagador_nome,
                        'quantity' => 1,
                        'price_cents' => $divida->pgm_valor
                    ],
                    'ignore_due_email' => false,
                    'ignore_canceled_email' => true,
                    'current_fines_option' => true,
                    'keep_early_payment_discount' => false
                ]
            ]);
            
            return $request;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * Buscar Fatura IUGU
     *
     * Retorna os dados de uma Fatura.
     *
     */
    public static function buscarFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu, [
                'form_params' => [
                    'id' => $divida->pgm_id_fatura_iugu
                ]
            ]);
            
            return $request;
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
     *
     */
    public static function listarFaturas()
    {
        try {
            $client = new Client();
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
     *
     */
    public static function enviarEmailFatura(Dividas $divida)
    {
        try {
            $client = new Client();
            $request = $client->post('https://api.iugu.com/v1/invoices/'.$divida->pgm_id_fatura_iugu.'send_email', [
                'form_params' => [
                    'id' => $divida->pgm_id_fatura_iugu
                ]
            ]);
            
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
	public static function criarCliente(Dividas $divida) {
		try {
			
			$client = new Client ( self::getHeaders () );
			
			$request = $client->post ( 'https://api.iugu.com/v1/customers', [ 
					'form_params' => [ 
							'email' => $divida->pgm_pagador_email,
							'name' => $divida->pgm_pagador_nome,
							'phone' => $divida->pgm_pagador_celular,
							'phone_prefix' => '47',
					        'phone' => substr ( $divida->pgm_pagador_celular, 2 ),
					        'phone_prefix' => substr ( $divida->pgm_pagador_celular, 0, 2 ),
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
	 * Alterar Cliente IUGU
	 *
	 * Alterar os dados de um Cliente. Quaisquer parâmetros não informados não serão alterados.
	 */
	public static function alterarCliente(Dividas $divida) {
	    try {
	        
	        $client = new Client ( self::getHeaders () );
	        
	        $request = $client->put ( 'https://api.iugu.com/v1/customers/'.$divida->pgm_id_cliente_iugu, [
	            'form_params' => [
	                'email' => $divida->pgm_pagador_email,
	                'name' => $divida->pgm_pagador_nome,
	                'notes' => $divida->pgm_intermediario_status,
	                "phone" => substr ( $divida->pgm_pagador_celular, 2 ),
	                "phone_prefix" => substr ( $divida->pgm_pagador_celular, 0, 2 ),
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
	 * Remover Cliente IUGU
	 *
	 * Remove permanentemente um cliente. Porém, não permite remover clientes com assinaturas ou faturas vinculadas.
	 */
	public static function alterarCliente($id) {
	    try {
	        
	        $client = new Client ( self::getHeaders () );
	        
	        $request = $client->delte ( 'https://api.iugu.com/v1/customers/'.$id);
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
	public static function buscarCliente($id) {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->get ( 'https://api.iugu.com/v1/customers/' . $id );
	        return $request;
	    } catch ( \Exception $e ) {
	        return $e->getMessage ();
	    }
	}
	
	/**
	 * Listar Clientes IUGU
	 *
	 * Retorna uma lista com todos os clientes cadastrados em sua conta ordenados pela data de Criação, sendo o primeiro o 
	 * que foi criado mais recentemente. O campo "totalItems" contém sempre a quantidade de clientes cadastrados, 
	 * independente dos parâmetros de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de "items".
	 */
	public static function listarClientes() {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->get ( 'https://api.iugu.com/v1/customers/');
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
	public static function criarFormaPagamento($customerId) {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->post ( 'https://api.iugu.com/v1/customers/' . $customerId . '/payment_methods', [
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
	 * Alterar Forma de Pagamento IUGU
	 *
	 * Cria uma Forma de Pagamento de Cliente.
	 */
	public static function alterarFormaPagamento($customerId, $id) {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->put ( 'https://api.iugu.com/v1/customers/' . $customerId . '/payment_methods'.$id, [
	            'form_params' => [
	                'description' => 'SmartClic',
	            ]
	        ] );
	        
	        return json_decode ( $request->getBody ()->getContents () );
	    } catch ( \Exception $e ) {
	        return $e->getMessage ();
	    }
	}
	
	/**
	 * Remover Forma de Pagamento IUGU
	 *
	 * Remove permanentemente uma forma de pagamento de um cliente.
	 */
	public static function removerFormaPagamento($customerId, $id) {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->delete ( 'https://api.iugu.com/v1/customers/' . $customerId . '/payment_methods'.$id, [
	            'form_params' => [
	                'description' => 'SmartClic',
	            ]
	        ] );
	        
	        return json_decode ( $request->getBody ()->getContents () );
	    } catch ( \Exception $e ) {
	        return $e->getMessage ();
	    }
	}
	
	
	/**
	 * Buscar Forma de Pagamento IUGU
	 *
	 * Retorna os dados de uma Forma de Pagamento de um Cliente
	 */
	public static function removerFormaPagamento($customerId, $id) {
	    try {
	        $client = new Client ( self::getHeaders () );
	        $request = $client->get ( 'https://api.iugu.com/v1/customers/' . $customerId . '/payment_methods'.$id);
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
	 * Pedido de Saque IUGU
	 *
	 * Faz um pedido de Saque de um valor
	 */
	public static function saque($id, $amount) {
	    try {
	        $client = new Client ();
	        $request = $client->post ( 'https://api.iugu.com/v1/accounts/' . $id . '/request_withdraw', [
	            'form_params' => [
	                'id' => $id,
	                'amount' => $amount
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


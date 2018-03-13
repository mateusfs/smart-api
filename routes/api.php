<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
 	Route::group(['middleware' => 'AuthToken'], function () {
 	    
 	    Route::delete('wallets/delete/{wal_id}', 'WalletsController@delete');
 	    Route::post('wallets/criar', 'WalletsController@criar');
 	    Route::post('wallets/atualizar', 'WalletsController@atualizar');
 	    Route::get('wallets/{wal_id}', 'WalletsController@index');
	 	
 	    Route::delete('debets/delete/{pgm_id}', 'DebetsController@delete');
 	    Route::post('debets/criar', 'DebetsController@criar');
 	    Route::post('debets/atualizar', 'DebetsController@atualizar');
     	Route::get('debets/{pgm_id}', 'DebetsController@index');
     	
     	Route::delete('itens/delete/{oit_id}', 'OrdersItemsController@delete');
     	Route::post('itens/criar', 'OrdersItemsController@criar');
     	Route::post('itens/atualizar', 'OrdersItemsController@atualizar');
     	Route::get('itens/{oit_id}', 'OrdersItemsController@index');
	 	
     	Route::delete('orders/delete/{ord_id}', 'OrdersController@delete');
     	Route::post('orders/criar', 'OrdersController@criar');
     	Route::post('orders/atualizar', 'OrdersController@atualizar');
     	Route::get('orders/{ord_id}', 'OrdersController@index');
	 	
     	Route::delete('payments/delete/{prc_id}', 'PaymentsAvailabilityController@delete');
     	Route::post('payments/criar', 'PaymentsAvailabilityController@criar');
     	Route::post('payments/atualizar', 'PaymentsAvailabilityController@atualizar');
	 	Route::get('payments/{prc_id}', 'PaymentsAvailabilityController@index');
	 	
	 	Route::delete('saques/delete/{saq_id}', 'SaquesController@delete');
	 	Route::get('saques/sacar/{saq_id}', 'SaquesController@sacar');
	 	Route::post('saques/atualizar', 'SaquesController@atualizar');
	 	Route::post('saques/criar', 'SaquesController@criar');
	 	Route::get('saques/{saq_id}', 'SaquesController@index');
	 	
	 	Route::get('pagament/boleto/{pgm_id}', 'PagamentController@gerarPagamentBoleto');
	 	Route::get('pagament/cartao/{pgm_id}', 'PagamentController@gerarPagamentCartao');
	 	Route::get('pagament/boleto/pessoaJuridica/{pgm_id}', 'PagamentController@gerarPagamentBoletoPessoaJuridica');
	 	Route::get('pagament/boleto/definirEndereco/{pgm_id}/{idTransacao}', 'PagamentController@definirEnderecoBoleto');
	 	
	 	
	 	Route::get('fatura/criar/', 'FaturaController@criarFatura');
	 	Route::get('fatura/listar/', 'FaturaController@listarFaturas');
	 	Route::get('fatura/capturar/{idFatura}', 'FaturaController@capturarFatura');
	 	Route::get('fatura/reembolsar/{idFatura}', 'FaturaController@reembolsarFatura');
	 	Route::get('fatura/cancelar/{idFatura}', 'FaturaController@cancelarFatura');
	 	Route::get('fatura/gerarSegundaVia/{idFatura}', 'FaturaController@gerarSegundaViaFatura');
	 	Route::get('fatura/buscar/{idFatura}', 'FaturaController@buscarFatura');
	 	Route::get('fatura/enviarEmail/{idFatura}', 'FaturaController@enviarEmail');
	 	
	 	Route::get('transferencia/listar/', 'TransferenciaController@listar');
	 	Route::get('transferencia/listarTransferenciasBancarias/', 'TransferenciaController@listarTransferenciasBancarias');
	 	Route::get('transferencia/buscarTransferenciaBancaria/', 'TransferenciaController@buscarTransferenciaBancaria');
	 	Route::get('transferencia/transferir/{idConta}/{valor}', 'TransferenciaController@transferir');
	 	Route::get('transferencia/buscar/{idTranferencia}', 'TransferenciaController@buscar');
	 	
	 	Route::post('transacao/criar/', 'TransacaoController@criar');
	 	Route::get('transacao/consultar/', 'TransacaoController@consultar');
	 	Route::get('transacao/atualizar/{pgm_id}', 'TransacaoController@atualizar');
	 	Route::get('transacao/detalhar/{idTransacao}', 'TransacaoController@detalhar');
	 	Route::get('transacao/cancelar/{idTransacao}', 'TransacaoController@cancelar');
	 	
	 	Route::post('contestar/disputar/', 'ContestarController@disputar');
	 	Route::get('contestar/listar/', 'ContestarController@listar');
	 	Route::get('contestar/acatar/{idContestacao}', 'ContestarController@acatar');
	 	Route::get('contestar/buscar/{idContestacao}', 'ContestarController@buscar');
	 	
	 	Route::get('financeiro/extratoFinanceiro', 'FinanceiroController@extratoFinanceiro');
	 	Route::get('financeiro/extratoFaturas', 'FinanceiroController@extratoFaturas');
	 	
 	});
 });


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
 	    
 	    Route::delete('carteiras/delete/{wal_id}', 'CarteirasController@delete');
 	    Route::post('carteiras/criar', 'CarteirasController@criar');
 	    Route::post('carteiras/atualizar', 'CarteirasController@atualizar');
 	    Route::get('carteiras/{wal_id}', 'CarteirasController@index');
	 	
 	    Route::delete('dividas/delete/{pgm_id}', 'DividasController@delete');
 	    Route::post('dividas/criar', 'DividasController@criar');
 	    Route::post('dividas/atualizar', 'DividasController@atualizar');
     	Route::get('dividas/{pgm_id}', 'DividasController@index');
     	
     	Route::delete('itens/delete/{oit_id}', 'ItensController@delete');
     	Route::post('itens/criar', 'ItensController@criar');
     	Route::post('itens/atualizar', 'ItensController@atualizar');
     	Route::get('itens/{oit_id}', 'ItensController@index');
	 	
     	Route::delete('pedidos/delete/{ord_id}', 'PedidosController@delete');
     	Route::post('pedidos/criar', 'PedidosController@criar');
     	Route::post('pedidos/atualizar', 'PedidosController@atualizar');
     	Route::get('pedidos/{ord_id}', 'PedidosController@index');
	 	
     	Route::delete('recebimentos/delete/{prc_id}', 'RecebimentosController@delete');
     	Route::post('recebimentos/criar', 'RecebimentosController@criar');
     	Route::post('recebimentos/atualizar', 'RecebimentosController@atualizar');
	 	Route::get('recebimentos/{prc_id}', 'RecebimentosController@index');
	 	
	 	Route::delete('saques/delete/{saq_id}', 'SaquesController@delete');
	 	Route::get('saques/sacar/{saq_id}', 'SaquesController@sacar');
	 	Route::post('saques/atualizar', 'SaquesController@atualizar');
	 	Route::post('saques/criar', 'SaquesController@criar');
	 	Route::get('saques/{saq_id}', 'SaquesController@index');
	 	
	 	Route::get('pagamento/boleto/{pgm_id}', 'PagamentoController@gerarPagamentoBoleto');
	 	Route::get('pagamento/cartao/{pgm_id}', 'PagamentoController@gerarPagamentoCartao');
	 	Route::get('pagamento/boleto/pessoaJuridica/{pgm_id}', 'PagamentoController@gerarPagamentoBoletoPessoaJuridica');
	 	Route::get('pagamento/boleto/definirEndereco/{pgm_id}/{idTransacao}', 'PagamentoController@definirEnderecoBoleto');
	 	
	 	
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


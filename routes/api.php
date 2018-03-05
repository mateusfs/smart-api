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
	 	
	 	
	 	Route::get('pagamento/boleto/{pgm_id}', 'PagamentoController@gerarBoleto');
	 	
 	});
 });


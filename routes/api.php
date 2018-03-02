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

 Route::prefix('/v1')->group(function () {
 	Route::group(['middleware' => 'AuthToken'], function () {
	 	Route::get('carteiras/{wal_id}', 'CarteirasController@index');
	 	Route::get('dividas/{pgm_id}', 'DividasController@index');
	 	Route::get('itens/{oit_id}', 'ItensController@index');
	 	Route::get('pedidos/{ord_id}', 'PedidosController@index');
	 	Route::get('recebimentos/{prc_id}', 'RecebimentosController@index');
	 	Route::get('saques/{saq_id}', 'SaquesController@index');
 	});
 });
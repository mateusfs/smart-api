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
 	    
 	    Route::get('wallet/{idWal}', 'WalletController@index');
 	    Route::post('wallet/create', 'WalletController@create');
 	    Route::post('wallet/update', 'WalletController@update');
 	    Route::delete('wallet/delete/{idWal}', 'WalletController@delete');
	 	
 	    Route::get('debt/{idPgm}', 'DebtController@index');
 	    Route::post('debt/create', 'DebtController@create');
 	    Route::post('debt/update', 'DebtController@update');
 	    Route::delete('debt/delete/{idPgm}', 'DebtController@delete');
     	
     	
     	Route::get('item/{idOit}', 'OrderItemController@index');
     	Route::post('item/create', 'OrderItemController@create');
     	Route::post('item/update', 'OrderItemController@update');
     	Route::delete('item/delete/{idOit}', 'OrderItemController@delete');
     	
     	Route::get('order/{idOrd}', 'OrderController@index');
     	Route::post('order/create', 'OrderController@create');
     	Route::post('order/update', 'OrderController@update');
     	Route::delete('order/delete/{idOrd}', 'OrderController@delete');
     	
     	Route::get('payment/{idPrc}', 'PaymentAvailabilityController@index');
     	Route::post('payment/create', 'PaymentAvailabilityController@create');
     	Route::post('payment/update', 'PaymentAvailabilityController@update');
     	Route::delete('payment/delete/{idPrc}', 'PaymentAvailabilityController@delete');
	 	
	 	Route::get('withdrawal/{idSaq}', 'WithdrawalController@index');
	 	Route::get('withdrawal/withdraw/{idSaq}', 'WithdrawalController@withdraw');
	 	Route::post('withdrawal/update', 'WithdrawalController@update');
	 	Route::post('withdrawal/create', 'WithdrawalController@create');
	 	Route::delete('withdrawal/delete/{idSaq}', 'WithdrawalController@delete');
	 	
	 	Route::get('pagament/ticket/{idPgm}', 'PagamentController@generatePagamentTicket');
	 	Route::get('pagament/card/{idPgm}', 'PagamentController@generatePagamentCard');
	 	Route::get('pagament/ticket/legalPerson/{idPgm}', 'PagamentController@generatePaymentLegalPerson');
	 	Route::get('pagament/ticket/setTicketAddress/{idPgm}/{idTransaction}', 'PagamentController@setTicketAddress');
	 	
	 	
	 	Route::get('invoice/create/', 'InvoiceController@create');
	 	Route::get('invoice/list/', 'InvoiceController@list');
	 	Route::get('invoice/capture/{idInvoice}', 'InvoiceController@capture');
	 	Route::get('invoice/refund/{idInvoice}', 'InvoiceController@refund');
	 	Route::get('invoice/cancel/{idInvoice}', 'InvoiceController@cancel');
	 	Route::get('invoice/generateSecondWay/{idInvoice}', 'InvoiceController@generateSecondWay');
	 	Route::get('invoice/search/{idInvoice}', 'InvoiceController@search');
	 	Route::get('invoice/sendEmail/{idInvoice}/{$to}', 'InvoiceController@sendEmail');
	 	
	 	Route::get('transfer/list/', 'TransferController@list');
	 	Route::get('transfer/listBankTransfers/', 'TransferController@listBankTransfers');
	 	Route::get('transfer/searchBankTransfer/', 'TransferController@searchBankTransfer');
	 	Route::get('transfer/transfer/{idAccount}/{value}', 'TransferController@transfer');
	 	Route::get('transfer/search/{idTransfer}', 'TransferController@search');
	 	
	 	Route::post('transaction/create/', 'TransactionController@create');
	 	Route::get('transaction/consult/', 'TransactionController@consult');
	 	Route::get('transaction/update/{pgm_id}', 'TransactionController@update');
	 	Route::get('transaction/detail/{idTransaction}', 'TransactionController@detail');
	 	Route::get('transaction/cancel/{idTransaction}', 'TransactionController@cancel');
	 	
	 	Route::post('contest/dispute/', 'ContestController@dispute');
	 	Route::get('contest/list/', 'ContestController@list');
	 	Route::get('contest/obey/{idContestation}', 'ContestController@obey');
	 	Route::get('contest/search/{idContestation}', 'ContestController@search');
	 	
	 	Route::get('financial/financialStatement', 'FinancialController@financialStatement');
	 	Route::get('financial/invoiceStatement', 'FinancialController@invoiceStatement');
	 	
 	});
 });


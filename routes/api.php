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
 	   	 
 		/**
 		 *  Contest
 		 */
 		Route::post('contest/dispute/', 'ContestController@dispute');
 		Route::get('contest/obey/{idContestation}', 'ContestController@obey');
 		Route::get('contest/search/{idContestation}', 'ContestController@search');
 		Route::get('contest/list/', 'ContestController@list');
 		
 		/**
 		 *  Debt
 		 */
 	    Route::get('debt/{idDbt?}/{dueAt?}/{value?}/{acceptBillet?}', 'DebtController@index');
 	    Route::post('debt/create', 'DebtController@create');
 	    Route::post('debt/update', 'DebtController@update');
 	    Route::delete('debt/delete/{idDbt}', 'DebtController@delete');
 	    
 	    /**
 	     *  Fee
 	     */
 	    Route::get('fee/{idFee?}/{createdAt?}/{value?}/{to?}', 'FeeController@index');
 	    Route::post('fee/create', 'FeeController@create');
 	    Route::post('fee/update', 'FeeController@update');
 	    Route::delete('fee/delete/{idFee}', 'FeeController@delete');
 	    
 	    /**
 	     *  Financial
 	     */
 	    Route::get('financial/financialStatement', 'FinancialController@financialStatement');
 	    Route::get('financial/invoiceStatement', 'FinancialController@invoiceStatement');
 	    
 	    /**
 	     *  Intermediator
 	     */
 	    Route::get('intermediator/{idInt?}/{title?}', 'IntermediatorController@index');
 	    Route::post('intermediator/create', 'IntermediatorController@create');
 	    Route::post('intermediator/update', 'IntermediatorController@update');
 	    Route::delete('intermediator/delete/{idInt}', 'IntermediatorController@delete');
 	    
 	    /**
 	     *  IntermediatorMethod
 	     */
 	    Route::get('intermediatorMethod/{idImt?}/{intermediatorId?}/{title?}/{type?}/{variable?}', 'IntermediatorMethodController@index');
 	    Route::post('intermediatorMethod/create', 'IntermediatorMethodController@create');
 	    Route::post('intermediatorMethod/update', 'IntermediatorMethodController@update');
 	    Route::delete('intermediatorMethod/delete/{idImt}', 'IntermediatorMethodController@delete');
 	    
 	    /**
 	     *  Invoice
 	     */
 	    Route::get('invoice/create/', 'InvoiceController@create');
 	    Route::get('invoice/list/', 'InvoiceController@list');
 	    Route::get('invoice/capture/{idInvoice}', 'InvoiceController@capture');
 	    Route::get('invoice/refund/{idInvoice}', 'InvoiceController@refund');
 	    Route::put('invoice/cancel/{idInvoice}', 'InvoiceController@cancel');
 	    Route::get('invoice/generateSecondWay/{idInvoice}', 'InvoiceController@generateSecondWay');
 	    Route::get('invoice/search/{idInvoice}', 'InvoiceController@search');
 	    Route::get('invoice/sendEmail/{idInvoice}/{to}', 'InvoiceController@sendEmail');
     	
 	    /**
 	     *  Item
 	     */
     	Route::get('item/{idOit?}/{order?}/{title?}/{type?}/{variable?}', 'ItemController@index');
     	Route::post('item/create', 'ItemController@create');
     	Route::post('item/update', 'ItemController@update');
     	Route::delete('item/delete/{idOit}', 'ItemController@delete');
     	
     	/**
     	 *  Order
     	 */
     	Route::get('order/{idOrd?}/{wallet?}/{status?}/{maturity?}', 'OrderController@index');
     	Route::post('order/create', 'OrderController@create');
     	Route::post('order/update', 'OrderController@update');
     	Route::delete('order/delete/{idOrd}', 'OrderController@delete');

     	/**
     	 *  Payment
     	 */
     	Route::get('payment/{idPgm?}/{wallet?}/{order?}/{value?}/{paymentName?}', 'PaymentController@index');
     	Route::post('payment/create', 'PaymentController@create');
     	Route::post('payment/update', 'PaymentController@update');
     	Route::delete('payment/delete/{idRcb}', 'PaymentController@delete');
     	Route::get('payment/ticket/{idPgm}', 'PaymentController@generatePagamentTicket');
     	Route::get('payment/card/{idPgm}', 'PaymentController@generatePagamentCard');
     	Route::get('payment/ticket/legalPerson/{idPgm}', 'PaymentController@generatePaymentLegalPerson');
     	Route::get('payment/ticket/setTicketAddress/{idPgm}/{idTransaction}', 'PaymentController@setTicketAddress');
     	
     	/**
     	 *  Receivable
     	 */
     	Route::get('receivable/{idRcb?}/{wallet?}/{value?}/{status?}', 'ReceivableController@index');
     	Route::post('receivable/create', 'ReceivableController@create');
     	Route::post('receivable/update', 'ReceivableController@update');
     	Route::delete('receivable/delete/{idRcb}', 'ReceivableController@delete');
	 	
     	/**
     	 *  Transaction
     	 */
     	Route::post('transaction/create/', 'TransactionController@create');
     	Route::post('transaction/update/', 'TransactionController@update');
     	Route::get('transaction/consult/', 'TransactionController@consult');
     	Route::get('transaction/detail/{idTransaction}', 'TransactionController@detail');
     	Route::get('transaction/cancel/{idTransaction}', 'TransactionController@cancel');
	 	
     	/**
     	 *  Transfer
     	 */
	 	Route::get('transfer/list/', 'TransferController@list');
	 	Route::get('transfer/listBankTransfers/', 'TransferController@listBankTransfers');
	 	Route::get('transfer/searchBankTransfer/', 'TransferController@searchBankTransfer');
	 	Route::get('transfer/transfer/{idAccount}/{value}', 'TransferController@transfer');
	 	Route::get('transfer/search/{idTransfer}', 'TransferController@search');

	 	/**
	 	 *  Wallet
	 	 */
	 	Route::get('wallet/{idWal?}/{title?}/{key?}/{intermediary?}', 'WalletController@index');
	 	Route::post('wallet/create', 'WalletController@create');
	 	Route::post('wallet/update', 'WalletController@update');
	 	Route::delete('wallet/delete/{idWal}', 'WalletController@delete');
	 	
	 	
	 	/**
	 	 *  Withdrawal
	 	 */
	 	Route::get('withdrawal/{idSaq?}/{wallet?}/{value?}/{status?}', 'WithdrawalController@index');
	 	Route::get('withdrawal/withdraw/{idSaq}', 'WithdrawalController@withdraw');
	 	Route::post('withdrawal/update', 'WithdrawalController@update');
	 	Route::post('withdrawal/create', 'WithdrawalController@create');
	 	Route::delete('withdrawal/delete/{idSaq}', 'WithdrawalController@delete');
	 	
	 	
	 	
 	});
 });


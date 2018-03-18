<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentAvailability;

/**
 * @resource PaymentAvailability
 */
class PaymentAvailabilityController extends Controller {
	/**
	 * Search Receiving
	 *
	 * Search Receiving | Example: api/v1/payment/$idPrc
	 *
	 * @param number $idPrc        	
	 */
    public function index($idPrc) 
	{
	    return PaymentAvailability::where ( 'prc_id', $idPrc )->firstOrFail ();
	}
	
	/**
	 * Create Receipt
	 *
	 * Create Receipt | Example: api/v1/payment/create
	 *
	 * @return void
	 */
	public function create(Request $request) 
	{
	    return PaymentAvailability::created ( $request );
	}
	
	/**
	 * Update Receiving
	 *
	 * Update Receiving | Example: api/v1/payment/update
	 *
	 * @return void
	 */
	public function update(Request $request) 
	{
	    $payment = PaymentAvailability::where ( 'prc_id', $request->prc_id )->firstOrFail ();
	    
	    if ($payment) 
	    {
	        $payment->save ();
	    }
	}
	
	/**
	 * Remove Receiving
	 *
	 * Remove Receiving | Example: api/v1/payment/delete/$idPrc
	 *
	 * @param number $idPrc        	
	 *
	 * @return int
	 */
	public function delete($idPrc) 
	{
	    $payment = PaymentAvailability::where ( 'prc_id', $idPrc )->firstOrFail ();
	    
		if ($payment) 
		{
			$payment->delete ();
		}
	}
}

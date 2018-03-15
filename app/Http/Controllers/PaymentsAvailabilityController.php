<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentsAvailability;

/**
 * @resource PaymentsAvailability
 */
class PaymentsAvailabilityController extends Controller {
	/**
	 * Search Receiving
	 *
	 * Search Receiving | Example: api/v1/payments/1
	 *
	 * @param number $prc_id        	
	 */
	public function index($prc_id) 
	{
	    return PaymentsAvailability::where ( 'prc_id', $prc_id )->firstOrFail ();
	}
	
	/**
	 * Create Receipt
	 *
	 * Create Receipt | Example: api/v1/payments/criar
	 *
	 * @return void
	 */
	public function criar(Request $request) 
	{
	    return PaymentsAvailability::created ( $request );
	}
	
	/**
	 * Update Receiving
	 *
	 * Update Receiving | Example: api/v1/payments/update
	 *
	 * @return void
	 */
	public function update(Request $request) 
	{
	    $payment = PaymentsAvailability::where ( 'prc_id', $request->prc_id )->firstOrFail ();
	    
	    if ($payment) 
	    {
	        $payment->save ();
	    }
	}
	
	/**
	 * Remove Receiving
	 *
	 * Remove Receiving | Example: api/v1/payments/delete/1
	 *
	 * @param number $prc_id        	
	 *
	 * @return int
	 */
	public function delete($prc_id) 
	{
	    $payment = PaymentsAvailability::where ( 'prc_id', $prc_id )->firstOrFail ();
	    
		if ($payment) 
		{
			$payment->delete ();
		}
	}
}

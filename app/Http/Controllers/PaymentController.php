<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Parameter;
use App\Gerencianet;
use App\Debt;
use App\Iugu;
use App\Repositories\PaymentRepository;
use GuzzleHttp\Psr7\Response;

/**
 * @resource Payment
 */
class PaymentController extends Controller {
	/**
	 * Search Receiving
	 *
	 * Search Receiving | Example: api/v1/payment/$idPrc
	 *
	 * @param number $idPrc
	 * @return Response       	
	 */
    public function index($idPrc) 
	{
	    return Payment::where ( 'prc_id', $idPrc )->firstOrFail ();
	}
	
	/**
	 * Create Receipt
	 *
	 * Create Receipt | Example: api/v1/payment/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) 
	{
	    return PaymentRepository::create($request);
	}
	
	/**
	 * Update Receiving
	 *
	 * Update Receiving | Example: api/v1/payment/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request) 
	{
	    return PaymentRepository::update($request);
	}
	
	/**
	 * Remove Receiving
	 *
	 * Remove Receiving | Example: api/v1/payment/delete/$idPrc
	 *
	 * @param number $idPrc        	
     * @return Response
	 */
	public function delete($idPrc) 
	{
	    $payment = Payment::where ( 'prc_id', $idPrc )->firstOrFail ();
	    
		if ($payment) 
		{
		    return PaymentRepository::delete($request);
		}
	}
	
	/**
	 * Generate Pay per Ticket
	 *
	 * Generate a ticket | Example: api/v1/payment/ticket/$idPgm
	 * 
	 * @param number $idPrc        	
     * @return Response
	 */
	public function generatePagamentTicket($idPgm)
	{
	    
	    $debt = Debt::where('pgm_id', $idPgm)->firstOrFail();
	    
	    if ($debt)
	    {
	        if (Parameter::getIsIugu())
	        {
	            $result = Iugu::issueTicket($debt);
	        }
	        
	        if (Parameter::getIsGerenciaNet())
	        {
	            $result = Gerencianet::issueTicket($debt);
	        }
	    }
	    
	    if($result)
	    {
	        return $result;
	    }
	    
	    return response()->json(["error" => "Payment ID is required"], 403);
	}
	
	
	/**
	 * Generate Pagament per ticket legal person
	 *
	 * Generate a pagament | Example: api/v1/payment/ticket/legalPerson/$idPgm
	 * 
	 * @param number $idPgm        	
     * @return Response
	 */
	public function generatePaymentLegalPerson($idPgm)
	{
	    
	    $debt = Debt::where('pgm_id', $idPgm)->firstOrFail();
	    
	    if ($debt)
	    {
	        if (Parameter::getIsGerenciaNet())
	        {
	            $result = Gerencianet::issueOfCorporateTaxes($debt, 5);
	        }
	    }
	    
	    if($result){
	        return $result;
	    }
	    
	    return response()->json(["error" => "Payment ID is required"], 403);
	}
	
	
	/**
	 * Generate payment by Card
	 *
	 * Generate a ticket | Example: api/v1/payment/card/$idPgm
	 * 
	 * @param number $idPgm        	
     * @return Response
	 */
	public function generatePagamentCard($idPgm)
	{
	    
	    $debt = Debt::where('pgm_id', $idPgm)->firstOrFail();
	    
	    
	    if ($debt)
	    {
	        if (Parameter::getIsIugu())
	        {
	            $result = Iugu::emetirCartao($debt);
	        }
	        
	        if (Parameter::getIsGerenciaNet())
	        {
	            $result = Gerencianet::pagarCartao($debt);
	        }
	    }
	    
	    
	    if($result)
	    {
	        return $result;
	    }
	    
	    return response()->json(["error" => "Payment ID is required"], 403);
	}
	
	
	/**
	 * Set address per ticket legal person
	 *
	 * Set a address for ticket | Example: api/v1/payment/ticket/setAddress/$idPgm/$idTransaction
	 * 
	 * @param number $idPgm
	 * @param number $idTransaction
	 *          	
     * @return Response
	 */
	public function setTicketAddress($idPgm, $idTransaction)
	{
	    
	    $debt = Debt::where('pgm_id', $pgm_id)->firstOrFail();
	    
	    if ($debt)
	    {
	        if (Parameter::getIsGerenciaNet())
	        {
	            $result = Gerencianet::setTicketAddress($idTransaction, $debt);
	        }
	    }
	    
	    if($result)
	    {
	        return $result;
	    }
	    
	    return response()->json(["error" => "Payment ID is required"], 403);
	}
}

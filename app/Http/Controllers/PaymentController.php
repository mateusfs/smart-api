<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Parameter;
use App\Gerencianet;
use App\Iugu;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Response;

/**
 * @resource Payment
 */
class PaymentController extends Controller {
	/**
	 * Search Payment
	 *
	 * Search Payment | Example: api/v1/payment/$idPgm
	 *
	 * @param number $idPgm
	 * @return Response       	
	 */
    public function index($idPgm) 
	{
		return Payment::where ( 'pgm_id', $idPgm)->firstOrFail ();
	}
	
	/**
	 * Create Payment
	 *
	 * Create Payment | Example: api/v1/payment/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) 
	{
		$paymentRepository = new PaymentRepository;
	    
		if($paymentRepository)
		{
			return $paymentRepository->create($request->all());
	    }
	    
	    return response()->json(["error" => "Problems creating a Payment"], 403);
	}
	
	/**
	 * Update Payment
	 *
	 * Update Payment | Example: api/v1/payment/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request) 
	{
		$paymentRepository = new PaymentRepository;
	    
		if($paymentRepository)
		{
			return $paymentRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a Payment"], 403);
	}
	
	/**
	 * Remove Payment
	 *
	 * Remove Payment | Example: api/v1/payment/delete/$idPrc
	 *
	 * @param number $idPrc        	
     * @return Response
	 */
	public function delete($idPrc) 
	{
		$payment = Payment::where ( 'pgm_id', $idPrc )->firstOrFail ();
	    
		$paymentRepository = new PaymentRepository;
		
		if($paymentRepository && $payment)
		{
			return $paymentRepository->delete($payment);
		}
		
		return response()->json(["error" => "Problems deleting a payment"], 403);
	}
	
	/**
	 * Generate Pay per Ticket
	 *
	 * Generate a ticket | Example: api/v1/payment/ticket/$idPgm
	 * 
	 * @param number $idPgm        	
     * @return Response
	 */
	public function generatePagamentTicket($idPgm)
	{
	    
		$receivable = Payment::where('pgm_id', $idPgm)->firstOrFail();
	    
		if ($receivable)
	    {
	        if (Parameter::getIsIugu())
	        {
	        	$result = Iugu::issueTicket($receivable);
	        }
	        
	        if (Parameter::getIsGerenciaNet())
	        {
	        	$result = Gerencianet::issueTicket($receivable);
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
	    
		$receivable = Payment::where('pgm_id', $idPgm)->firstOrFail();
	    
		if ($receivable)
	    {
	        if (Parameter::getIsGerenciaNet())
	        {
	        	$result = Gerencianet::issueOfCorporateTaxes($receivable, 5);
	        }
	    }
	    
	    if($result){
	        return $result;
	    }
	    
	    return response()->json(["error" => "Receivable ID is required"], 403);
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
	    
		$receivable = Payment::where('pgm_id', $idPgm)->firstOrFail();
	    
	    
		if ($receivable)
	    {
	        if (Parameter::getIsIugu())
	        {
	        	$result = Iugu::emetirCartao($receivable);
	        }
	        
	        if (Parameter::getIsGerenciaNet())
	        {
	        	$result = Gerencianet::pagarCartao($receivable);
	        }
	    }
	    
	    
	    if($result)
	    {
	        return $result;
	    }
	    
	    return response()->json(["error" => "Receivable ID is required"], 403);
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
	    
		$receivable = Payment::where('pgm_id', $idPgm)->firstOrFail();
	    
		if ($receivable)
	    {
	        if (Parameter::getIsGerenciaNet())
	        {
	        	$result = Gerencianet::setTicketAddress($idTransaction, $receivable);
	        }
	    }
	    
	    if($result)
	    {
	        return $result;
	    }
	    
	    return response()->json(["error" => "Receivable ID is required"], 403);
	}
}

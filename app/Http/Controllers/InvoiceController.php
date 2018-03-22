<?php
namespace App\Http\Controllers;

use App\Debt;
use App\Services\Iugu;
use App\Services\Parameter;
use Illuminate\Http\Response;

/**
 * @resource Invoice
 */
class InvoiceController extends Controller
{

    /**
     * Generate Invoice pelo IUGU
     *
     * Generate a invoice | Example: api/v1/invoice/create/$idPgm
     * 
     * @param number $idPgm
	 * @return Response
     */
    public function create($idPgm)
    {
        
        $debt = Debt::where('pgm_id', $idPgm)->firstOrFail();
        
        if ($debt) {
            if (Parameter::getIsIugu()) {
                
                $emails = $debt->pgm_pagador_email.',smart@smartclic.com.br';
                
                $dataVencimento = date('Y-m-d') + 3;
                
                $items = Iugu::getItems($debt->pgm_pagador_nome, 1, $debt->pgm_valor);
                
                $returnUrl = 'http://smartclic.com.br/';
                
                $expiredUrl = 'http://smartclic.com.br/';
                
                $logs = Iugu::getLogs();
                
                $custonVariables = Iugu::getCustonVariables($debt->pgm_pagador_nome, $debt->pgm_valor);
                
                $result = Iugu::createInvoice($debt->pgm_pagador_email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, false, '', true, '', $idCliente, false, null, 'all', null, false, $logs, null, $custonVariables);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    
    /**
     * Capturar Invoice 
     *
     * Capturar a invoice | Example: api/v1/invoice/capture/$idInvoice
     * 
     * @param number $idInvoice
	 * @return Response
     */
    public function capture($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::captureInvoice($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    
    /**
     * Repay Invoice
     *
     * Repay a invoice | Example: api/v1/invoice/refund/$idInvoice
     * 
     * @param number $idInvoice
	 * @return Response
     */
    public function refund($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::refundInvoice($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    
    /**
     * Cancel Invoice
     *
     * Cancel a invoice | Example: api/v1/invoice/cancel/$idInvoice
     * 
     * @param number $idInvoice
	 * @return Response
     */
    public function cancel($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::cancelInvoice($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    
    
    /**
     * Generate Second Way Invoice
     *
     * Generate a second way invoice | Example: api/v1/invoice/generateSecondWay/$idInvoice
     * 
     * @param number $idInvoice
	 * @return Response
     */
    public function generateSecondWay($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::gerarateSecondInvoicePath($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    

    /**
     * Search Invoice
     *
     * Search a invoice | Example: api/v1/invoice/search/$idInvoice
     * 
     * @param number $idInvoice
	 * @return Response
     */
    public function search($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::searchInvoice($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    /**
     * Search Invoice
     *
     * Search a invoice | Example: api/v1/invoice/list/
     * 
	 * @return Response
     */
    public function list()
    {
        
        if($idInvoice){
            $result = Iugu::listInvoices();
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "We had trouble listing as invoices"], 403);
    }
    
    
    /**
     * Send Email Invoice
     *
     * Send a email invoice | Example: api/v1/invoice/sendEmail/$idInvoice/$to
     */
    public function sendEmail($idInvoice, $to)
    {
        
        if($idInvoice && $to){
            $result = Iugu::sendEmail($idInvoice, $to);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
}

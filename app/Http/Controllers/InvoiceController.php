<?php
namespace App\Http\Controllers;

use App\Debets;
use App\Parametros;
use App\Iugu;

/**
 * @resource Invoice
 */
class InvoiceController extends Controller
{

    /**
     * Generate Invoice pelo IUGU
     *
     * Generate a invoice | Example: api/v1/invoice/create
     */
    public function createInvoice($pgm_id)
    {
        
        $divida = Debets::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($divida) {
            if (Parametros::getIsIugu()) {
                
                $emails = $divida->pgm_pagador_email.',smart@smartclic.com.br';
                
                $dataVencimento = date('Y-m-d') + 3;
                
                $items = Iugu::getItems($divida->pgm_pagador_nome, 1, $divida->pgm_valor);
                
                $returnUrl = 'http://smartclic.com.br/';
                
                $expiredUrl = 'http://smartclic.com.br/';
                
                $logs = Iugu::getLogs();
                
                $custonVariables = Iugu::getCustonVariables($divida->pgm_pagador_nome, $divida->pgm_valor);
                
                $result = Iugu::criarFatura($divida->pgm_pagador_email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, false, '', true, '', $idCliente, false, null, 'all', null, false, $logs, null, $custonVariables);
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
     */
    public function captureFatura($idInvoice)
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
     * Repay a invoice | Example: api/v1/invoice/repay/$idInvoice
     */
    public function reembolsarInvoice($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::reembolsarInvoice($idInvoice);
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
     */
    public function cancelInvoice($idInvoice)
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
     */
    public function gerarSegundaViaFatura($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::gerarSegundaViaFatura($idInvoice);
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
     */
    public function buscarFatura($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::buscarFatura($idInvoice);
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
     */
    public function listarFaturas()
    {
        
        if($idInvoice){
            $result = Iugu::listInvoices();
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
    
    
    /**
     * Send Email Invoice
     *
     * Send a email invoice | Example: api/v1/invoice/sendEmail/
     */
    public function sendEmail($idInvoice)
    {
        
        if($idInvoice){
            $result = Iugu::listInvoice($idInvoice);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Invoice ID is required"], 403);
    }
}

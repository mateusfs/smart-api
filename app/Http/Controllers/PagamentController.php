<?php
namespace App\Http\Controllers;

use App\Debt;
use App\Parameter;
use App\Iugu;
use App\Gerencianet;

/**
 * @resource Pagament
 */
class PagamentController extends Controller
{

    /**
     * Generate Pay per Ticket
     *
     * Generate a ticket | Example: api/v1/pagament/ticket/$idPgm
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
        
        return response()->json(["error" => "Debt ID is required"], 403);
    }

    
    /**
     * Generate Pagament per ticket legal person
     *
     * Generate a pagament | Example: api/v1/pagament/ticket/legalPerson/$idPgm
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
        
        return response()->json(["error" => "Debt ID is required"], 403);
    }
    
    
    /**
     * Generate payment by Card
     *
     * Generate a ticket | Example: api/v1/pagament/card/$idPgm
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
        
        return response()->json(["error" => "Debt ID is required"], 403);
    }
    
    
    /**
     * Set address per ticket legal person
     *
     * Set a address for ticket | Example: api/v1/pagament/ticket/setAddress/$idPgm/$idTransaction
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
        
        return response()->json(["error" => "Debt ID is required"], 403);
    }

}

<?php
namespace App\Http\Controllers;

use App\Debets;
use App\Parametros;
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
     * Generate a ticket | Example: api/v1/pagament/ticket/$pgm_id
     */
    public function generatePagamentTicket($pgm_id)
    {
        
        $debet = Debets::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($debet) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::issueTicket($debet);
            }
            
            if (Parametros::getIsGerenciaNet()) 
            {
                $result = Gerencianet::issueTicket($debet);
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
        
        $debet = Debets::where('pgm_id', $idPgm)->firstOrFail();
        
        if ($debet) 
        {
            if (Parametros::getIsGerenciaNet()) 
            {
                $result = Gerencianet::issueOfCorporateTaxes($debet, 5);
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
    public function gerarPagamentCartao($idPgm)
    {
        
        $debet = Debets::where('pgm_id', $idPgm)->firstOrFail();

        
        if ($debet) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::emetirCartao($debet);
            }
            
            if (Parametros::getIsGerenciaNet()) 
            {
                $result = Gerencianet::pagarCartao($debet);
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
        
        $debet = Debets::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($debet) 
        {
            if (Parametros::getIsGerenciaNet()) 
            {
                $result = Gerencianet::setTicketAddress($idTransaction, $debet);
            }
        }
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "Debt ID is required"], 403);
    }

}

<?php
namespace App\Http\Controllers;

use App\Parametros;
use App\Iugu;
use Gerencianet\Request;

/**
 * @resource Contest
 */
class ContestController extends Controller
{

    /**
     * Dispute contestation IUGU
     *
     * Dispute contestation | Exemplo: api/v1/contest/dispute/
     */
    public function disputar(Request $request)
    {
        
        $idContest = $request->idContest;
        $files = $request->files;
     
        if ($idContestation && $files) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::disputeContestation($idContestation, $files);
            }
        }
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "Contestation of ID is required"], 403);
    }
    
    
    /**
     * Dispute Contest IUGU
     *
     * Dispute contest | Exemplo: api/v1/contest/obey/$idContestation
     */
    public function obey($idContestation)
    {
        
        if ($idContestation) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::obeyContestacao($idContestation);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Contestation of ID is required"], 403);
    }
    
    /**
     * Search Contest IUGU
     *
     * Search Contest | Exemplo: api/v1/contest/buscar/$idContestation
     */
    public function buscar($idContestation)
    {
        
        if ($idContestation) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::searchContestation($idContestation);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Contestation of ID is required"], 403);
    }
    
    /**
     * List Contest IUGU
     *
     * List a contest | Exemplo: api/v1/contest/list/$idContestation
     */
    public function list($idContestation)
    {
        
        if ($idContestation) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::listContestation($idContestation);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Contestation of ID is required"], 403);
    }
    
    
    

}

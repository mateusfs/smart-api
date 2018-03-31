<?php
namespace App\Http\Controllers;

use App\Services\Parameter;
use App\Services\Gerencianet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @resource Transaction
 */
class TransactionController extends Controller
{

    /**
     * Update Transaction GerenciaNet
     *
     * Update a transaction | Example: api/v1/transaction/create
     * 
     * @param Request $resquest        	
     * @return Response
     */
    public function create(Request $resquest)
    {
        
        $name = $resquest->name;
        $aumont = $resquest->aumont;
        $value = $resquest->value;
        
        if ($name && $aumont && $value) {
            if (Parameter::getIsGerenciaNet()) {
                $result = Gerencianet::createTransaction($name, $amount, $value);
            }
            
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Transaction name, aumont and value is required"], 403);
    }
    
    
    /**
     * Update Transaction GerenciaNet
     *
     * Update a transaction | Example: api/v1/transaction/update
     * 
     * @param Request $resquest        	
     * @return Response
     */
    public function update(Request $resquest)
    {
        
        $idTransaction = $resquest->idTransaction;
        $url = $resquest->url;
        
        if ($idTransaction && $url) {
            if (Parameter::getIsGerenciaNet()) {
                $result = Gerencianet::updateTranslation($idTransaction, $url);
            }
            
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Transaction Id is required"], 403);
    }
    
    
    /**
     * Detail Transaction GerenciaNet
     *
     * Detail a transaction | Example: api/v1/transaction/detail/$idTransaction
     * 
     * @param number $idTransaction        	
     * @return Response
     */
    public function detail($idTransaction)
    {
        
        if ($idTransaction) 
        {
            if (Parameter::getIsGerenciaNet()) 
            {
                $result = Gerencianet::detailTransactions($idTransaction);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Transaction Id is required"], 403);
    }
    
    
    /**
     * Cancel Transaction GerenciaNet
     *
     * Cancel a transaction | Example: api/v1/transaction/cancel/$idTransaction
     * 
     * @param number $idTransaction        	
     * @return Response
     */
    public function cancel($idTransaction)
    {
        
        if ($idTransaction) {
            if (Parameter::getIsGerenciaNet()) {
                $result = Gerencianet::cancelTransaction($idTransaction);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Transaction Id is required"], 403);
    }
    
    
    /**
     * Consult Notification Transaction GerenciaNet
     *
     * Consult a notification | Example: api/v1/transaction/consult/$idTransaction
     * 
     * @param number $idTransaction        	
     * @return Response
     */
    public function consult()
    {
        
        $result = Gerencianet::ConsultNotification();
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "We are having trouble making an appointment."], 403);
    }
}


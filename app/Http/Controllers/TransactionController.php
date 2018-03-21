<?php
namespace App\Http\Controllers;

use App\Parameter;
use Gerencianet\Request;
use App\Gerencianet;
use Illuminate\Http\Response;

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
        
        $nome = $resquest->nome;
        $quantidade = $resquest->quantidade;
        $valor = $resquest->valor;
        
        if ($nome && $quantidade && $valor) {
            if (Parameter::getIsGerenciaNet()) {
                $result = Gerencianet::criarTransaction($nome, $quantidade, $valor);
            }
            
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Transaction Id is required"], 403);
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


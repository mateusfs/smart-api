<?php
namespace App\Http\Controllers;

use App\Parametros;
use Gerencianet\Request;
use App\Gerencianet;

/**
 * @resource Transaction
 */
class TransactionController extends Controller
{

    /**
     * Update Transaction GerenciaNet
     *
     * Update a transaction | Example: api/v1/transaction/create
     */
    public function create(Request $resquest)
    {
        
        $nome = $resquest->nome;
        $quantidade = $resquest->quantidade;
        $valor = $resquest->valor;
        
        if ($nome && $quantidade && $valor) {
            if (Parametros::getIsGerenciaNet()) {
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
     */
    public function atualizar(Request $resquest)
    {
        
        $idTransaction = $resquest->idTransaction;
        $url = $resquest->url;
        
        if ($idTransaction && $url) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::atualizarTransaction($idTransaction, $url);
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
     */
    public function detalhar($idTransaction)
    {
        
        if ($idTransaction) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::detalharTransacoes($idTransaction);
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
     */
    public function cancelar($idTransaction)
    {
        
        if ($idTransaction) {
            if (Parametros::getIsGerenciaNet()) {
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
     * Consult a notification | Example: api/v1/transaction/cancel/$idTransaction
     */
    public function Consult()
    {
        
        $result = Gerencianet::ConsultNotification();
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "We are having trouble making an appointment."], 403);
    }
}


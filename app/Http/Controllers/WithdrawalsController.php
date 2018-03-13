<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Withdrawals;
use App\Iugu;
use App\Gerencianet;
use App\Parametros;



/**
 * @resource Withdrawals
 *
 */
class WithdrawalsController extends Controller
{
    /**
     * Buscar Withdrawal
     *
     * Buscar Withdrawal | Exemplo: api/v1/withdrawals/1
     *
     * @param number $saq_id
     */
	public function index($saq_id)
	{
		return Withdrawal::where('saq_id', $saq_id)->firstOrFail();
	}
	
	/**
	 * Criar Withdrawal
	 *
	 * Criar Withdrawal | Exemplo: api/v1/withdrawals/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
		return Withdrawal::created($request);
	}
	
	/**
	 * Atualizar Withdrawal
	 *
	 * Atualizar Withdrawal | Exemplo: api/v1/withdrawals/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return Withdrawal::updated($request);
	}
	
	
	/**
	 * Remover Withdrawal
	 *
	 * Remover Withdrawal | Exemplo: api/v1/withdrawals/delete/1
	 *
	 * @param number $prc_id
	 *
	 * @return int
	 */
	public function delete($prc_id)
	{
		$withdrawal = Withdrawal::where('saq_id', $saq_id)->firstOrFail();
	    if($withdrawal){
	    	$withdrawal->delete();
	    }
	}
	
	
	/**
	 * Pedido de Withdrawal
	 *
	 * Pedido de Withdrawal | Exemplo: api/v1/withdrawals/sacar/1
	 *
	 * @return void
	 */
	public function sacar($saq_id)
	{
	    
		$saque = Withdrawal::where('saq_id', $saq_id)->firstOrFail();
	    
	    
	    dd('Realizar Saque');
	    
	    if($saque)
	    {
	        if(Parametros::getIsIugu()){
	            $customVariables = Iugu::getCustonVariables($saque->saq_intermediario, $saque->saq_valor);
	            
	            $subConta = Iugu::criarSubconta($saque->saq_intermediario, null);
	            
	            if($subConta){
	                $result = Iugu::pedidoDeSaque($subConta['account_id'], $saque->saq_valor, $customVariables);
	            }
	        }

	        if(Parametros::getIsGerenciaNet()){
	            $result = GerenciaNet::criarTransacao($saque->saq_intermediario, 1, $saque->saq_valor);
	        }
	        
	    }
	    
	    if($result){
	        return $result;
        }
        
        return response()->json(["error" => "Id do Saque é obrigatório"], 403);
	}
	

	
	
}

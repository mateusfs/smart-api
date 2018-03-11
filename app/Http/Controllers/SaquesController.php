<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saques;
use App\Iugu;
use App\Gerencianet;
use App\Parametros;



/**
 * @resource Saques
 *
 */
class SaquesController extends Controller
{
    /**
     * Buscar Saque
     *
     * Buscar Saque | Exemplo: api/v1/saques/1
     *
     * @param number $saq_id
     */
	public function index($saq_id)
	{
		return Saques::where('saq_id', $saq_id)->firstOrFail();
	}
	
	/**
	 * Criar Saque
	 *
	 * Criar Saque | Exemplo: api/v1/saques/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Saques::created($request);
	}
	
	/**
	 * Atualizar Saque
	 *
	 * Atualizar Saque | Exemplo: api/v1/saques/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return Saques::updated($request);
	}
	
	
	/**
	 * Remover Saque
	 *
	 * Remover Saque | Exemplo: api/v1/saques/delete/1
	 *
	 * @param number $prc_id
	 *
	 * @return int
	 */
	public function delete($prc_id)
	{
	    return Saques::destroy($prc_id);
	}
	
	
	/**
	 * Pedido de Saque
	 *
	 * Pedido de Saque | Exemplo: api/v1/saques/sacar/1
	 *
	 * @return void
	 */
	public function sacar($saq_id)
	{
	    
	    $saque = Saques::where('saq_id', $saq_id)->firstOrFail();
	    
	    
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

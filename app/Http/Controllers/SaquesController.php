<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saques;
use App\Iugu;
use App\Gerencianet;



/**
 * @resource Saques
 *
 * Buscar Saque
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
	    
	    if($saque)
	    {
	        if($saque->saq_intermediario_code ==  Iugu::$clientId){
	            Iugu::saque($saque->saq_id, $saque->saq_valor);
	        }

	        if($saque->saq_intermediario_code ==  Gerencianet::$clientId){
	            GerenciaNet::criarTransacao($saque->saq_id, 1, $saque->saq_valor);
	        }
	        
	    }
	    
	    /*
	     *  $client
	     *
	     *  RETORNO API EXTERNA
	     *
	     *  IMPLEMENTAR LOGICA
	     *
	     */
	    
	    return $client;
	}
	

	
	
}

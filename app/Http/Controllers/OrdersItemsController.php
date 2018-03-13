<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdersItems;

/**
 * @resource Itens
 *
 */
class OrdersItemsController extends Controller
{
    /**
     * Buscar Iten
     *
     * Buscar Iten | Exemplo: api/v1/items/1
     *
     * @param number $oit_id
     */
	public function index($oit_id)
	{
		return OrdersItems::where('oit_id', $oit_id)->firstOrFail();
	}
	
	/**
	 * Criar Iten
	 *
	 * Criar Iten | Exemplo: api/v1/itens/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
		return OrdersItems::created($request);
	}
	
	/**
	 * Atualizar Iten
	 *
	 * Atualizar Iten | Exemplo: api/v1/itens/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return OrdersItems::updated($request);
	}
	
	
	/**
	 * Remover Iten
	 *
	 * Remover Iten | Exemplo: api/v1/itens/delete/1
	 *
	 * @param number $oit_id
	 * 
	 * @return int
	 */
	public function delete($oit_id)
	{
		$iten = OrdersItems::where('oit_id', $oit_id)->firstOrFail();
		if($iten){
			$iten->delete();
		}
	}
}

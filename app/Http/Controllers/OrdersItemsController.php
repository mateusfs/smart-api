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
     * Search Iten
     *
     * Search Iten | Exemplo: api/v1/itens/1
     *
     * @param number $oit_id
     */
	public function index($oit_id)
	{
		return OrdersItems::where('oit_id', $oit_id)->firstOrFail();
	}
	
	/**
	 * Create Iten
	 *
	 * Create Iten | Exemplo: api/v1/itens/create
	 *
	 * @return void
	 */
	public function create(Request $request)
	{
		return OrdersItems::created($request);
	}
	
	/**
	 * Update Iten
	 *
	 * Update Iten | Exemplo: api/v1/itens/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
		$iten = OrdersItems::where('oit_id', $request->oit_id)->firstOrFail();
		
		if($iten)
		{
		    $iten->save();
		}
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
		
		if($iten)
		{
			$iten->delete();
		}
	}
}

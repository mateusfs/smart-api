<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderItem;

/**
 * @resource OrderItem
 *
 */
class OrderItemController extends Controller
{
    /**
     * Search Item
     *
     * Search Item | Exemplo: api/v1/item/$idOit
     *
     * @param number $idOit
     */
	public function index($idOit)
	{
	    return OrderItem::where('oit_id', $idOit)->firstOrFail();
	}
	
	/**
	 * Create Item
	 *
	 * Create Item | Exemplo: api/v1/item/create
	 *
	 * @return void
	 */
	public function create(Request $request)
	{
		return OrderItem::created($request);
	}
	
	/**
	 * Update Item
	 *
	 * Update Item | Exemplo: api/v1/item/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
		$item = OrderItem::where('oit_id', $request->oit_id)->firstOrFail();
		
		if($item)
		{
		    $item->save();
		}
	}
	
	
	/**
	 * Remover Item
	 *
	 * Remover Item | Exemplo: api/v1/item/delete/$idOit
	 *
	 * @param number $idOit
	 * 
	 * @return int
	 */
	public function delete($idOit)
	{
	    $item = OrderItem::where('oit_id', $idOit)->firstOrFail();
		
		if($item)
		{
			$item->delete();
		}
	}
}

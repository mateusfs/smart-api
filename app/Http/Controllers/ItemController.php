<?php

namespace App\Http\Controllers;

use App\Item;
use App\Repositories\ItemRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @resource Item
 *
 */
class ItemController extends Controller
{
    /**
     * Search Item
     *
     * Search Item | Exemplo: api/v1/item/$idOit
     *
     * @param number $idOit
     * @return Response
     */
	public function index($idOit)
	{
	    if(request('order')){
	        return Item::where ( 'oit_pedido', '==', request('order'))->firstOrFail ();
	    }
	    
	    if(request('title')){
	        return Item::where ( 'oit_titulo', '==', request('title'))->firstOrFail ();
	    }
	    
	    if(request('type')){
	        return Item::where ( 'oit_tipo', '==', request('type'))->firstOrFail ();
	    }
	    
	    if(request('value')){
	        return Item::where ( 'oit_valor', '==', request('value'))->firstOrFail ();
	    }
	    
	    return Item::where('oit_id', $idOit)->firstOrFail();
	}
	
	/**
	 * Create Item
	 *
	 * Create Item | Exemplo: api/v1/item/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
		$itemRepository = new ItemRepository;
		
		if($itemRepository){
			return $itemRepository->create($request->all());
		}
		
		return response()->json(["error" => "Problems creating a item"], 403);
	}
	
	/**
	 * Update Item
	 *
	 * Update Item | Exemplo: api/v1/item/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$itemRepository = new ItemRepository;
	    
	    if($itemRepository){
	    	return $itemRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a item"], 403);
	}
	
	
	/**
	 * Remover Item
	 *
	 * Remover Item | Exemplo: api/v1/item/delete/$idOit
	 *
	 * @param number $idOit
	 * @return Response
	 */
	public function delete($idOit)
	{
	    $item = Item::where('oit_id', $idOit)->firstOrFail();
		
	    $itemRepository = new ItemRepository;
	    
	    if($itemRepository&& $order)
	    {
	    	return $itemRepository->delete($order);
	    }
	    
	    return response()->json(["error" => "Problems deleting a item"], 403);
	}
}

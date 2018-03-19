<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Repositories\ItemRepository;
use GuzzleHttp\Psr7\Response;

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
		return ItemRepository::create($request);
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
	    return ItemRepository::update($request);
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
		
		if($item)
		{
		    return ItemRepository::delete($item);
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;

/**
 * @resource Orders
 *
 */
class OrdersController extends Controller
{
    /**
     * Search Order
     *
     * Search a order | Exemplo: api/v1/orders/1
     *
     * @param number $ord_id
     */
    public function index($ord_id)
	{
		return Orders::where('ord_id', $ord_id)->firstOrFail();
	}
	
	/**
	 * Create Order
	 *
	 * Create a order | Exemplo: api/v1/itens/create
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
		return Orders::created($request);
	}
	
	/**
	 * Update Order
	 *
	 * Update a Order | Exemplo: api/v1/orders/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
    	$order = Orders::where('ord_id', $request->ord_id)->firstOrFail();
    	
		if($order)
		{
		    $order->save();
		}
	}
	
	
	/**
	 * Remove Order
	 *
	 * Remove Order | Exemplo: api/v1/orders/delete/1
	 *
	 * @param number $ord_id
	 * 
	 * @return int
	 */
	public function delete($ord_id)
	{
		$order = Orders::where('ord_id', $ord_id)->firstOrFail();
		if($order)
		{
			$order->delete();
		}
	}
}

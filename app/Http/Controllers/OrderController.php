<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

/**
 * @resource Order
 *
 */
class OrderController extends Controller
{
    /**
     * Search Order
     *
     * Search a order | Exemplo: api/v1/orders/1
     *
     * @param number $idOrd
     */
    public function index($idOrd)
	{
	    return Order::where('ord_id', $idOrd)->firstOrFail();
	}
	
	/**
	 * Create Order
	 *
	 * Create a order | Exemplo: api/v1/itens/create
	 *
	 * @return void
	 */
	public function create(Request $request)
	{
		return Order::created($request);
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
    	$order = Order::where('ord_id', $request->ord_id)->firstOrFail();
    	
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
	 * @param number $idOrd
	 * 
	 * @return int
	 */
	public function delete($idOrd)
	{
	    $order = Order::where('ord_id', $idOrd)->firstOrFail();
		if($order)
		{
			$order->delete();
		}
	}
}

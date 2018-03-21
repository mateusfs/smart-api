<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Response;

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
     * @return Response
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
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
		$orderRepository = new OrderRepository;
		
		if($orderRepository){
			return $orderRepository->create($request->all());
		}
		
		return response()->json(["error" => "Problems creating a ordem"], 403);
	}
	
	/**
	 * Update Order
	 *
	 * Update a Order | Exemplo: api/v1/orders/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
	    $orderRepository = new OrderRepository;
	    
	    if($orderRepository){
	    	return $orderRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a ordem"], 403);
	}
	
	
	/**
	 * Remove Order
	 *
	 * Remove Order | Exemplo: api/v1/orders/delete/1
	 *
	 * @param number $idOrd
	 * @return Response
	 */
	public function delete($idOrd)
	{
	    $order = Order::where('ord_id', $idOrd)->firstOrFail();
	    
		if($order)
		{
		    return OrderRepository::delete($order);
		}
	}
}

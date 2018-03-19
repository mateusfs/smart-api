<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Repositories\OrderRepository;
use GuzzleHttp\Psr7\Response;

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
		return OrderRepository::create($request);
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
	    return OrderRepository::update($request);
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

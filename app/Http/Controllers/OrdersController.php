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
     * Buscar Order
     *
     * Buscar Order | Exemplo: api/v1/orders/1
     *
     * @param number $ord_id
     */
    public function index($ord_id)
	{
		return Orders::where('ord_id', $ord_id)->firstOrFail();
	}
	
	/**
	 * Criar Order
	 *
	 * Criar Order | Exemplo: api/v1/itens/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
		return Orders::created($request);
	}
	
	/**
	 * Atualizar Order
	 *
	 * Atualizar Order | Exemplo: api/v1/orders/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return Orders::updated($request);
	}
	
	
	/**
	 * Remover Order
	 *
	 * Remover Order | Exemplo: api/v1/orders/delete/1
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

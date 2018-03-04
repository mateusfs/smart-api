<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedidos;

/**
 * @resource Pedidos
 *
 */
class PedidosController extends Controller
{
    /**
     * Buscar Pedido
     *
     * Buscar Pedido | Exemplo: smart/api/v1/pedidos/1
     *
     * @param number $ord_id
     */
    public function index($ord_id)
	{
		return Pedidos::where('ord_id', $ord_id)->firstOrFail();
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
	    return Pedidos::created($request);
	}
	
	
	/**
	 * Remover Iten
	 *
	 * Remover Iten | Exemplo: smart/api/v1/itens/delete/1
	 *
	 * @param number $ord_id
	 * 
	 * @return int
	 */
	public function delete($ord_id)
	{
	    return Pedidos::destroy($ord_id);
	}
}

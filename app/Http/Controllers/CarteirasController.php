<?php

namespace App\Http\Controllers;
use App\Carteiras;
use Illuminate\Http\Request;

/**
 * @resource Carteiras
 *
 * Controller Carteira
 */

class CarteirasController extends Controller
{
    /**
     * Buscar Carteira
     *
     * Buscar Carteira | Exemplo: api/v1/carteiras/1
     * 
     * @param number $wal_id
     * 
     * @return Carteiras
     */
	public function index($wal_id)
	{
		return Carteiras::where('wal_id', $wal_id)->firstOrFail();
	}
	
	
	/**
	 * Criar Carteira
	 *
	 * Criar Carteira | Exemplo: api/v1/carteiras/criar
	 * 
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Carteiras::created($request);
	}
	
	
	/**
	 * Remover Carteira
	 *
	 * Remover Carteira | Exemplo: api/v1/carteiras/delete/1
	 * 
	 * @param number $wal_id
	 * 
	 * @return int
	 */
	public function delete($wal_id)
	{
	    return Carteiras::destroy($wal_id);
	}
}

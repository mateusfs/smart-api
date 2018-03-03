<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dividas;

/**
 * @resource Dividas
 *
 * Buscar Divida
 */
class DividasController extends Controller
{
    /**
     * Buscar Divida
     *
     * Buscar Divida | Exemplo: api/v1/dividas/1
     * 
     * @param number $pgm_id
     */
	public function index($pgm_id)
	{
		return Dividas::where('pgm_id', $pgm_id)->firstOrFail();
	}
	
	/**
	 * Criar Divida
	 *
	 * Criar Divida | Exemplo: api/v1/dividas/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Dividas::created($request);
	}
	
	
	/**
	 * Remover Divida
	 *
	 * Remover Divida | Exemplo: api/v1/dividas/delete/1
	 *
	 * @param number $pgm_id
	 * 
	 * @return int
	 */
	public function delete($pgm_id)
	{
	    return Dividas::destroy($pgm_id);
	}
}

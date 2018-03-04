<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recebimentos;

/**
 * @resource Recebimentos
 *
 */
class RecebimentosController extends Controller
{
    /**
     * Buscar Recebimento
     *
     * Buscar Recebimento | Exemplo: smart/api/v1/recebimentos/1
     *
     * @param number $prc_id
     */
	public function index($prc_id)
	{
		return Recebimentos::where('prc_id', $prc_id)->firstOrFail();
	}
	
	
	/**
	 * Criar Recebimento
	 *
	 * Criar Recebimento | Exemplo: smart/api/v1/recebimentos/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Recebimentos::created($request);
	}
	
	
	/**
	 * Remover Recebimento
	 *
	 * Remover Recebimento | Exemplo: smart/api/v1/recebimentos/delete/1
	 *
	 * @param number $prc_id
	 *
	 * @return int
	 */
	public function delete($prc_id)
	{
	    return Recebimentos::destroy($prc_id);
	}
}

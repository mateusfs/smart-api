<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Saques;

/**
 * @resource Saques
 *
 * Buscar Saque
 */
class SaquesController extends Controller
{
    /**
     * Buscar Saque
     *
     * Buscar Saque | Exemplo: api/v1/saques/1
     *
     * @param number $saq_id
     */
	public function index($saq_id)
	{
		return Saques::where('saq_id', $saq_id)->firstOrFail();
	}
	
	/**
	 * Criar Saque
	 *
	 * Criar Saque | Exemplo: api/v1/saques/criar
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Saques::created($request);
	}
	
	
	/**
	 * Remover Saque
	 *
	 * Remover Saque | Exemplo: api/v1/saques/delete/1
	 *
	 * @param number $prc_id
	 *
	 * @return int
	 */
	public function delete($prc_id)
	{
	    return Saques::destroy($prc_id);
	}
}

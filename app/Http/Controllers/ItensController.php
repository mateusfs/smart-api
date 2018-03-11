<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Itens;

/**
 * @resource Itens
 *
 */
class ItensController extends Controller
{
    /**
     * Buscar Iten
     *
     * Buscar Iten | Exemplo: api/v1/itens/1
     *
     * @param number $oit_id
     */
	public function index($oit_id)
	{
		return Itens::where('oit_id', $oit_id)->firstOrFail();
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
	    return Itens::created($request);
	}
	
	/**
	 * Atualizar Iten
	 *
	 * Atualizar Iten | Exemplo: api/v1/itens/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return Itens::updated($request);
	}
	
	
	/**
	 * Remover Iten
	 *
	 * Remover Iten | Exemplo: api/v1/itens/delete/1
	 *
	 * @param number $oit_id
	 * 
	 * @return int
	 */
	public function delete($oit_id)
	{
	    return Itens::destroy($oit_id);
	}
}

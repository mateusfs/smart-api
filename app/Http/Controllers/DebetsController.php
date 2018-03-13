<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debets;

/**
 * @resource Debets
 */
class DebetsController extends Controller {
	/**
	 * Buscar Debet
	 *
	 * Buscar Debet | Exemplo: api/v1/debets/1
	 *
	 * @param number $pgm_id        	
	 */
	public function index($pgm_id) {
		return Debets::where ( 'pgm_id', $pgm_id )->firstOrFail ();
	}
	
	/**
	 * Criar Debet
	 *
	 * Criar Debet | Exemplo: api/v1/debets/criar
	 *
	 * @return void
	 */
	public function criar(Request $request) {
		return debets::created ( $request );
	}
	
	/**
	 * Atualizar Debet
	 *
	 * Atualizar Debet | Exemplo: api/v1/debets/criar
	 *
	 * @return void
	 */
	public function atualizar(Request $request) {
		return Debets::updated ( $request );
	}
	
	/**
	 * Remover Debet
	 *
	 * Remover Debet | Exemplo: api/v1/debets/delete/1
	 *
	 * @param number $pgm_id        	
	 *
	 * @return int
	 */
	public function delete($pgm_id) {
		$debet = Debets::where ( 'pgm_id', $pgm_id )->firstOrFail ();
		if ($debet) 
		{
			$debet->delete();
		}
	}
}

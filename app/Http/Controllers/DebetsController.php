<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debets;

/**
 * @resource Debets
 */
class DebetsController extends Controller {
	/**
	 * Search Debet
	 *
	 * Search Debet | Exemplo: api/v1/debets/1
	 *
	 * @param number $idPgm        	
	 */
	public function index($idPgm) {
		return Debets::where ( 'pgm_id', $idPgm )->firstOrFail ();
	}
	
	/**
	 * Create Debet
	 *
	 * Create Debet | Exemplo: api/v1/debets/create
	 *
	 * @return void
	 */
	public function criar(Request $request) {
		return debets::created ( $request );
	}
	
	/**
	 * Update Debet
	 *
	 * Update Debet | Exemplo: api/v1/debets/create
	 *
	 * @return void
	 */
	public function update(Request $request) 
	{
		$debet = Debets::where ( 'pgm_id', $request->id_pgm )->firstOrFail ();
		
		if ($debet)
		{
		    $debet->save();
		}
	}
	
	/**
	 * Remove Debet
	 *
	 * Remove Debet | Exemplo: api/v1/debets/delete/1
	 *
	 * @param number $idPgm        	
	 *
	 * @return int
	 */
	public function delete($idPgm) 
	{
	    
		$debet = Debets::where ( 'pgm_id', $idPgm )->firstOrFail ();
		
		if ($debet) 
		{
			$debet->delete();
		}
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debt;

/**
 * @resource Debt
 */
class DebtController extends Controller {
	/**
	 * Search Debt
	 *
	 * Search Debt | Exemplo: api/v1/Debt/$idPgm
	 *
	 * @param number $idPgm        	
	 */
	public function index($idPgm) {
		return Debt::where ( 'pgm_id', $idPgm )->firstOrFail ();
	}
	
	/**
	 * Create Debt
	 *
	 * Create Debt | Exemplo: api/v1/Debt/create
	 *
	 * @return void
	 */
	public function create(Request $request) {
		return Debt::created ( $request );
	}
	
	/**
	 * Update Debt
	 *
	 * Update Debt | Exemplo: api/v1/Debt/create
	 *
	 * @return void
	 */
	public function update(Request $request) 
	{
		$Debt = Debt::where ( 'pgm_id', $request->id_pgm )->firstOrFail ();
		
		if ($debt)
		{
		    $debt->save();
		}
	}
	
	/**
	 * Remove Debt
	 *
	 * Remove Debt | Exemplo: api/v1/Debt/delete/$idPgm
	 *
	 * @param number $idPgm        	
	 *
	 * @return int
	 */
	public function delete($idPgm) 
	{
	    
	    $debt = Debt::where ( 'pgm_id', $idPgm )->firstOrFail ();
		
		if ($debt) 
		{
		    $debt->delete();
		}
	}
}

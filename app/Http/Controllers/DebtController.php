<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Debt;
use App\Repositories\DebtRepository;
use GuzzleHttp\Psr7\Response;

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
	 * @return Response        	
	 */
	public function index($idPgm) {
		return Debt::where ( 'pgm_id', $idPgm )->firstOrFail ();
	}
	
	/**
	 * Create Debt
	 *
	 * Create Debt | Exemplo: api/v1/Debt/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
	    return DebtRepository::create($request);
	}
	
	/**
	 * Update Debt
	 *
	 * Update Debt | Exemplo: api/v1/Debt/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request) 
	{
	    return DebtRepository::update($request);
	}
	
	/**
	 * Remove Debt
	 *
	 * Remove Debt | Exemplo: api/v1/Debt/delete/$idPgm
	 *
	 * @param number $idPgm        	
     * @return Response
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

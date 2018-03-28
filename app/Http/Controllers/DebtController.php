<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Repositories\DebtRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @resource Debt
 */
class DebtController extends Controller {
	/**
	 * Search Debt
	 *
	 * Search Debt | Exemplo: api/v1/debt/$idDbt
	 *
	 * @param number $idDbt
	 * @return Response
	 */
	public function index($idDbt) {
		return Debt::where ( 'dbt_id', $idDbt)->firstOrFail ();
	}

	/**
	 * Create Debt
	 *
	 * Create Debt | Exemplo: api/v1/debt/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
		
		$debtRepository = new DebtRepository;
		
		if($debtRepository){
			return $debtRepository->create($request->all());
		}

		return response()->json(["error" => "Problems creating a withdrawal"], 403);
	}

	/**
	 * Update Debt
	 *
	 * Update Debt | Exemplo: api/v1/debt/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$debtRepository = new DebtRepository;
		
		if($debtRepository){
			return $debtRepository->update($request->all());
		}
		
		return response()->json(["error" => "Problems updating a withdrawal"], 403);
	}

	/**
	 * Delete Debt
	 *
	 * Delete Debt | Exemplo: api/v1/debt/delete/$idDbt
	 *
	 * @param number $idDbt
     * @return true |false
	 */
	public function delete($idDbt)
	{

	    $debt = Debt::where ( 'dbt_id', $idDbt )->firstOrFail ();

	    $debtRepository = new DebtRepository;
	    
	    if($debtRepository && $debt)
	    {
	    	return $debtRepository->delete($debt);
	    }
	    
	    return response()->json(["error" => "Problems deleting a debt"], 403);
	}
}

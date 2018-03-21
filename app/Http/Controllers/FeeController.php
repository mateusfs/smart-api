<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fee;
use App\Repositories\FeeRepository;
use Illuminate\Http\Response;

/**
 * @resource Fee
 */
class FeeController extends Controller {
	/**
	 * Search Fee
	 *
	 * Search Fee | Exemplo: api/v1/fee/$idFee
	 *
	 * @param number $idFee
	 * @return Response
	 */
	public function index($idFee) {
		return Fee::where ( 'int_id', $idFee)->firstOrFail ();
	}

	/**
	 * Create Fee
	 *
	 * Create Fee | Exemplo: api/v1/fee/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
		
		$FeeRepository = new FeeRepository;
		
		if($FeeRepository){
			return $FeeRepository->create($request->all());
		}

		return response()->json(["error" => "Problems creating a fee"], 403);
	}

	/**
	 * Update Fee
	 *
	 * Update Fee | Exemplo: api/v1/fee/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$FeeRepository = new feeRepository;
		
		if($FeeRepository){
			return $FeeRepository->update($request->all());
		}
		
		return response()->json(["error" => "Problems updating a fee"], 403);
	}

	/**
	 * Remove Fee
	 *
	 * Remove Fee | Exemplo: api/v1/fee/delete/$idFee
	 *
	 * @param number $idFee
     * @return Response
	 */
	public function delete($idFee)
	{

		$Fee = Fee::where ( 'int_id', $idFee)->firstOrFail ();

		if ($Fee)
		{
		    $Fee->delete();
		}
	}
}

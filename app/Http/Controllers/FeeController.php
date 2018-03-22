<?php

namespace App\Http\Controllers;


use App\Fee;
use App\Repositories\FeeRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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
		return Fee::where ( 'fee_id', $idFee)->firstOrFail ();
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
		
		$feeRepository = new FeeRepository;
		
		if($feeRepository){
			return $feeRepository->create($request->all());
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
		$feeRepository = new feeRepository;
		
		if($feeRepository){
			return $feeRepository->update($request->all());
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

		$fee = Fee::where ( 'fee_id', $idFee)->firstOrFail ();

		$feeRepository = new feeRepository;
		
		if($feeRepository && $fee)
		{
			return $feeRepository->delete($fee);
		}
		
		return response()->json(["error" => "Problems deleting a fee"], 403);
	}
}

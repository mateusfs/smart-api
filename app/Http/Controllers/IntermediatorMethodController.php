<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IntermediatorMethod;
use App\Repositories\IntermediatorMethodRepository;
use Illuminate\Http\Response;

/**
 * @resource IntermediatorMethod
 */
class IntermediatorMethodController extends Controller {
	/**
	 * Search Intermediator Method
	 *
	 * Search Intermediator Method | Exemplo: api/v1/intermediatorMethod/$idImt
	 *
	 * @param number $idPgm
	 * @return Response
	 */
	public function index($idImt) {
		return IntermediatorMethod::where ( 'imt_id', $idImt)->firstOrFail ();
	}

	/**
	 * Create Intermediator Method
	 *
	 * Create Intermediator Method | Exemplo: api/v1/intermediatorMethod/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
		
		$intermediatorMethodRepository = new IntermediatorMethodRepository;
		
		if($intermediatorMethodRepository){
			return $intermediatorMethodRepository->create($request->all());
		}

		return response()->json(["error" => "Problems creating a method intermediator"], 403);
	}

	/**
	 * Update Intermediator Method
	 *
	 * Update Intermediator Method | Exemplo: api/v1/intermediatorMethod/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$intermediatorMethodRepository = new IntermediatorMethodRepository;
		
		if($intermediatorMethodRepository){
			return $intermediatorMethodRepository->update($request->all());
		}
		
		return response()->json(["error" => "Problems updating a method intermediator"], 403);
	}

	/**
	 * Remove Intermediator Method
	 *
	 * Remove Intermediator Method | Exemplo: api/v1/intermediatorMethod/delete/$idImt
	 *
	 * @param number $idImt
     * @return Response
	 */
	public function delete($idImt)
	{

		$intermediatorMethod = IntermediatorMethod::where ( 'imt_id', $idImt)->firstOrFail ();

		$intermediatorMethodRepository = new IntermediatorMethodRepository;
		
		if($intermediatorMethodRepository && $intermediatorMethod)
		{
			return $intermediatorMethodRepository->delete($intermediatorMethod);
		}
		
		return response()->json(["error" => "Problems deleting a method intermediator"], 403);
	}
}

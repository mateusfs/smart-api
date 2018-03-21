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
	 * Search IntermediatorMethod
	 *
	 * Search IntermediatorMethod | Exemplo: api/v1/intermediatorMethod/$idImt
	 *
	 * @param number $idPgm
	 * @return Response
	 */
	public function index($idImt) {
		return IntermediatorMethod::where ( 'imt_id', $idImt)->firstOrFail ();
	}

	/**
	 * Create IntermediatorMethod
	 *
	 * Create IntermediatorMethod | Exemplo: api/v1/intermediatorMethod/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) {
		
		$intermediatorMethodRepository = new IntermediatorMethodRepository;
		
		if($intermediatorMethodRepository){
			return $intermediatorMethodRepository->create($request->all());
		}

		return response()->json(["error" => "Problems creating a withdrawal"], 403);
	}

	/**
	 * Update IntermediatorMethod
	 *
	 * Update IntermediatorMethod | Exemplo: api/v1/intermediatorMethod/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
		$intermediatorMethodRepository= new IntermediatorMethodRepository;
		
		if($intermediatorMethodRepository){
			return $intermediatorMethodRepository->update($request->all());
		}
		
		return response()->json(["error" => "Problems updating a withdrawal"], 403);
	}

	/**
	 * Remove IntermediatorMethod
	 *
	 * Remove IntermediatorMethod | Exemplo: api/v1/intermediatorMethod/delete/$idImt
	 *
	 * @param number $idImt
     * @return Response
	 */
	public function delete($idImt)
	{

		$intermediatorMethod = IntermediatorMethod::where ( 'imt_id', $idImt)->firstOrFail ();

		if ($intermediatorMethod)
		{
			$intermediatorMethod->delete();
		}
	}
}

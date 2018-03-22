<?php

namespace App\Http\Controllers;

use App\Intermediator;
use App\Repositories\IntermediatorRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @resource Intermediator
 *
 */
class IntermediatorController extends Controller
{
    /**
     * Search Intermediator
     *
     * Search a intermediator | Exemplo: api/v1/intermediator/$idInt
     *
     * @param number $idInt
     * @return Response
     */
	public function index($idInt)
	{
		return Intermediator::where('int_id', $idInt)->firstOrFail();
	}
	
	/**
	 * Create Intermediator
	 *
	 * Create a intermediator | Exemplo: api/v1/intermediator/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
	    $intermediatorRepository = new IntermediatorRepository;
	    
	    if($intermediatorRepository){
	    	return $intermediatorRepository->create($request->all());
	    }
	    
	    return response()->json(["error" => "Problems creating a intermediator"], 403);
	}
	
	/**
	 * Update Intermediator
	 *
	 * Update a intermediator | Exemplo: api/v1/intermediator/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{   
	    $intermediatorRepository = new IntermediatorRepository;
	    
	    if($intermediatorRepository){
	    	return $intermediatorRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a intermediator"], 403);
	}
	
	
	/**
	 * Remover Intermediator
	 *
	 * Remover a intermediator | Exemplo: api/v1/intermediator/delete/$idInt
	 *
     * @param number $idInt
	 * @return Response
	 */
	public function delete($idInt)
	{
		$intermediator = Intermediator::where('int_id', $idInt)->firstOrFail();
	    
	    $intermediatorRepository = new IntermediatorRepository;
	    
	    if($intermediatorRepository && $intermediator)
	    {
	    	return $intermediatorRepository->delete($intermediator);
	    }
	    
	    return response()->json(["error" => "Problems deleting a intermediator"], 403);
	}
	

	
	
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receivable;
use App\Parameter;
use App\Gerencianet;
use App\Iugu;
use App\Repositories\ReceivableRepository;
use Illuminate\Http\Response;

/**
 * @resource Receivable
 */
class ReceivableController extends Controller {
	/**
	 * Search Receivable
	 *
	 * Search Receivable | Example: api/v1/payment/$idRcb
	 *
	 * @param number $idRcb
	 * @return Response       	
	 */
    public function index($idRcb) 
	{
		return Receivable::where ( 'rcb_id', $idRcb)->firstOrFail ();
	}
	
	/**
	 * Create Receivable
	 *
	 * Create Receivable | Example: api/v1/receivable/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request) 
	{
		$receivableRepository = new ReceivableRepository;
	    
		if($receivableRepository){
			return $receivableRepository->create($request->all());
	    }
	    
	    return response()->json(["error" => "Problems creating a receivable"], 403);
	}
	
	/**
	 * Update Receivable
	 *
	 * Update Receivable | Example: api/v1/receivable/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request) 
	{
		$receivableRepository = new ReceivableRepository;
	    
		if($receivableRepository){
			return $receivableRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a receivable"], 403);
	}
	
	/**
	 * Remove Receivable
	 *
	 * Remove Receivable | Example: api/v1/receivable/delete/$idPrc
	 *
	 * @param number $idPrc        	
     * @return Response
	 */
	public function delete($idPrc) 
	{
		$receivable = Receivable::where ( 'rcb_id', $idPrc )->firstOrFail ();
	    
		$receivableRepository = new ReceivableRepository;
		
		if($receivableRepository&& $receivable)
		{
			return $receivableRepository->delete($receivable);
		}
		
		return response()->json(["error" => "Problems deleting a receivable"], 403);
	}
	
}

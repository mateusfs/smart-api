<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Intermediator;
use App\Repositories\IntermediatorRepository;

/**
 * @resource Intermediator
 *
 */
class IntermediatorController extends Controller
{
    /**
     * Search Intermediator
     *
     * Search a intermediator | Exemplo: api/v1/intermediator/$idSaq
     *
     * @param number $idSaq
     * @return Response
     */
    public function index($idSaq)
	{
	    return Intermediator::where('saq_id', $idSaq)->firstOrFail();
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
	    return IntermediatorRepository::create($request);
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
	    return IntermediatorRepository::update($request);
	}
	
	
	/**
	 * Remover Intermediator
	 *
	 * Remover a intermediator | Exemplo: api/v1/intermediator/delete/$idSaq
	 *
     * @param number $idSaq
	 * @return Response
	 */
	public function delete($idSaq)
	{
	    $intermediator = Intermediator::where('saq_id', $idSaq)->firstOrFail();
	    
	    if($intermediator)
	    {
	        return IntermediatorRepository::delete($intermediator);
	    }
	}
	

	
	
}

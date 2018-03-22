<?php

namespace App\Http\Controllers;


use App\Withdrawal;
use App\Repositories\WithdrawalRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;



/**
 * @resource Withdrawal
 *
 */
class WithdrawalController extends Controller
{
    /**
     * Search Withdrawal
     *
     * Search a withdrawal | Exemplo: api/v1/withdrawal/$idSaq
     *
     * @param number $idSaq
     * @return Response
     */
    public function index($idSaq)
	{
	    return Withdrawal::where('saq_id', $idSaq)->firstOrFail();
	}
	
	/**
	 * Create Withdrawal
	 *
	 * Create a withdrawal | Exemplo: api/v1/withdrawal/create
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
	    $withdrawalRepository = new WithdrawalRepository;
	    
	    if($withdrawalRepository){
	    	return $withdrawalRepository->create($request->all());
	    }
	    
	    return response()->json(["error" => "Problems creating a withdrawal"], 403);
	}
	
	/**
	 * Update Withdrawal
	 *
	 * Update a withdrawal | Exemplo: api/v1/withdrawal/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
	    $withdrawalRepository = new WithdrawalRepository;
	    
	    if($withdrawalRepository){
	    	return $withdrawalRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a withdrawal"], 403);
	}
	
	
	/**
	 * Remover Withdrawal
	 *
	 * Remover a withdrawal | Exemplo: api/v1/withdrawal/delete/$idSaq
	 *
     * @param number $idSaq
	 * @return Response
	 */
	public function delete($idSaq)
	{
	    $withdrawal = Withdrawal::where('saq_id', $idSaq)->firstOrFail();
	    
	    $withdrawalRepository = new WithdrawalRepository;
	    
	    if($withdrawalRepository && $withdrawal)
	    {
	    	return $withdrawalRepository->delete($withdrawal);
	    }
	    
	    return response()->json(["error" => "Problems deleting a withdrawal"], 403);
	}
	
	
	/**
	 * Withdraw of Withdrawal
	 *
	 * Withdraw of withdrawal | Exemplo: api/v1/withdrawal/withdraw/$idSaq
	 *
	 * @param number $idSaq
     * @return Response
	 */
	public function withdraw($idSaq)
	{
	    $withdraw = Withdrawal::where('saq_id', $idSaq)->firstOrFail();
	       
	    if($withdrawal)
	    {
	        return WithdrawalRepository::withdraw($withdrawal);
	    }
	}
	

	
	
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Withdrawal;
use App\Repositories\WithdrawalRepository;
use GuzzleHttp\Psr7\Response;



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
	    return WithdrawalRepository::create($request);
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
	    return WithdrawalRepository::update($request);
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
	    
	    if($withdrawal)
	    {
	        return WithdrawalRepository::delete($withdrawal);
	    }
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
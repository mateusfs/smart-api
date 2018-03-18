<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Withdrawal;
use App\Iugu;
use App\Gerencianet;
use App\Parameter;



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
	 * @return void
	 */
	public function create(Request $request)
	{
	    return Withdrawal::created($request);
	}
	
	/**
	 * Update Withdrawal
	 *
	 * Update a withdrawal | Exemplo: api/v1/withdrawal/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
	    $withdrawal = Withdrawal::where('saq_id', $saq_id)->firstOrFail();
	    if($withdrawal){
	        $withdrawal->save();
	    }
	}
	
	
	/**
	 * Remover Withdrawal
	 *
	 * Remover a withdrawal | Exemplo: api/v1/withdrawal/delete/$idSaq
	 *
	 * @param number $idSaq
	 *
	 * @return int
	 */
	public function delete($idSaq)
	{
	    $withdrawal = Withdrawal::where('saq_id', $idSaq)->firstOrFail();
	    if($withdrawal){
	    	$withdrawal->delete();
	    }
	}
	
	
	/**
	 * Order de Withdrawal
	 *
	 * Order of withdrawal | Exemplo: api/v1/withdrawal/withdraw/$idSaq
	 *
	 * @return void
	 */
	public function withdraw($idSaq)
	{
	    
	    $withdraw = Withdrawal::where('saq_id', $idSaq)->firstOrFail();
	    
	    
	    dd('Realizar Saque');
	    
	    if($withdraw)
	    {
	        if(Parameter::getIsIugu())
	        {
	            $customVariables = Iugu::getCustonVariables($withdraw->saq_intermediario, $withdraw->saq_valor);
	            
	            $subAccount = Iugu::orderOfWithdrawal($withdraw->saq_intermediario, null);
	            
	            if($subAccount)
	            {
	                $result = Iugu::requestWithdrawal($subAccount['account_id'], $withdraw->saq_valor, $customVariables);
	            }
	        }
	        
	        if(Parameter::getIsGerenciaNet())
	        {
	            $result = GerenciaNet::createTransaction($withdraw->saq_intermediario, 1, $withdraw->saq_valor);
	        }
	        
	    }
	    
	    if($result)
	    {
	        return $result;
        }
        
        return response()->json(["error" => "Serving ID is required"], 403);
	}
	

	
	
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Withdrawals;
use App\Iugu;
use App\Gerencianet;
use App\Parametros;



/**
 * @resource Withdrawals
 *
 */
class WithdrawalsController extends Controller
{
    /**
     * Search Withdrawal
     *
     * Search a withdrawal | Exemplo: api/v1/withdrawals/$saq_id
     *
     * @param number $saq_id
     */
	public function index($saq_id)
	{
	    return Withdrawals::where('saq_id', $saq_id)->firstOrFail();
	}
	
	/**
	 * Create Withdrawal
	 *
	 * Create a withdrawal | Exemplo: api/v1/withdrawals/create
	 *
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Withdrawals::created($request);
	}
	
	/**
	 * Update Withdrawal
	 *
	 * Update a withdrawal | Exemplo: api/v1/withdrawals/atualizar
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
	    return Withdrawals::updated($request);
	}
	
	
	/**
	 * Remover Withdrawal
	 *
	 * Remover a withdrawal | Exemplo: api/v1/withdrawals/delete/$prc_id
	 *
	 * @param number $prc_id
	 *
	 * @return int
	 */
	public function delete($prc_id)
	{
	    $withdrawal = Withdrawals::where('saq_id', $saq_id)->firstOrFail();
	    if($withdrawal){
	    	$withdrawal->delete();
	    }
	}
	
	
	/**
	 * Order de Withdrawal
	 *
	 * Order of withdrawal | Exemplo: api/v1/withdrawals/withdraw/$saq_id
	 *
	 * @return void
	 */
	public function withdraw($saq_id)
	{
	    
	    $withdraw = Withdrawals::where('saq_id', $saq_id)->firstOrFail();
	    
	    
	    dd('Realizar Saque');
	    
	    if($withdraw)
	    {
	        if(Parametros::getIsIugu())
	        {
	            $customVariables = Iugu::getCustonVariables($withdraw->saq_intermediario, $withdraw->saq_valor);
	            
	            $subAccount = Iugu::orderOfWithdrawal($withdraw->saq_intermediario, null);
	            
	            if($subAccount)
	            {
	                $result = Iugu::requestWithdrawal($subAccount['account_id'], $withdraw->saq_valor, $customVariables);
	            }
	        }

	        if(Parametros::getIsGerenciaNet())
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

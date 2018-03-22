<?php

namespace App\Http\Controllers;
use App\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @resource Wallet
 *
 */

class WalletController extends Controller
{
    /**
     * Search Wallet
     *
     * Search a wallet | Exemplo: api/v1/wallet/$idWal
     * 
     * @param number $idWal
     * @return Response
     */
	public function index($idWal)
	{
	    return Wallet::where('wal_id', $idWal)->firstOrFail();
	}
	
	
	/**
	 * Create Wallet
	 *
	 * Create a wallet | Exemplo: api/v1/wallet/create
	 * 
	 * @param Request $request
	 * @return Response
	 */
	public function create(Request $request)
	{
	    $walletRepository = new WalletRepository;
	    
	    if($walletRepository){
	    	return $walletRepository->create($request->all());
	    }
	    
	    return response()->json(["error" => "Problems creating a wallet"], 403);
	}
	
	/**
	 * Update Wallet
	 *
	 * Update a wallet | Exemplo: api/v1/wallet/update
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request)
	{
	    $walletRepository = new WalletRepository;
	    
	    if($walletRepository){
	    	return $walletRepository->update($request->all());
	    }
	    
	    return response()->json(["error" => "Problems updating a wallet"], 403);
	}
	
	
	/**
	 * Delete Wallet
	 *
	 * Delete Wallet | Exemplo: api/v1/wallet/delete/$idWal
	 * 
	 * @param number $idWal
	 * @return Response
	 */
	public function delete($idWal)
	{
	    $wallet = Wallet::where('wal_id', $idWal)->firstOrFail();
		
	    $walletRepository = new WalletRepository;
	    
	    if($walletRepository && $wallet)
	    {
	    	return $walletRepository->delete($wallet);
	    }
	    
	    return response()->json(["error" => "Problems deleting a wallet"], 403);
	}
}

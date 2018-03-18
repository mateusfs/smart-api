<?php

namespace App\Http\Controllers;
use App\Wallet;
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
     * 
     * @return Wallet
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
	 * @return void
	 */
	public function create(Request $request)
	{
	    return Wallet::created($request);
	}
	
	/**
	 * Update Wallet
	 *
	 * Update a wallet | Exemplo: api/v1/wallet/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
	    $wallet = Wallet::where('wal_id', $request->wal_id)->firstOrFail();
    	
		if($wallet)
		{
		    $wallet->save();
		}
	}
	
	
	/**
	 * Remove Wallet
	 *
	 * Remove Wallet | Exemplo: api/v1/wallet/delete/$idWal
	 * 
	 * @param number $idWal
	 * 
	 * @return int
	 */
	public function delete($idWal)
	{
	    $wallet = Wallet::where('wal_id', $idWal)->firstOrFail();
		
		if($wallet)
		{
			$wallet->delete();
		}
	}
}

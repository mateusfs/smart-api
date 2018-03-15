<?php

namespace App\Http\Controllers;
use App\Wallets;
use Illuminate\Http\Request;

/**
 * @resource wallets
 *
 */

class WalletsController extends Controller
{
    /**
     * Search Wallet
     *
     * Search a wallet | Exemplo: api/v1/wallets/1
     * 
     * @param number $wal_id
     * 
     * @return wallets
     */
	public function index($wal_id)
	{
		return Wallets::where('wal_id', $wal_id)->firstOrFail();
	}
	
	
	/**
	 * Create Wallet
	 *
	 * Create a wallet | Exemplo: api/v1/wallets/create
	 * 
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Wallets::created($request);
	}
	
	/**
	 * Update Wallet
	 *
	 * Update a wallet | Exemplo: api/v1/wallets/update
	 *
	 * @return void
	 */
	public function update(Request $request)
	{
	    $wallet = Wallets::where('wal_id', $request->wal_id)->firstOrFail();
    	
		if($wallet)
		{
		    $wallet->save();
		}
	}
	
	
	/**
	 * Remove Wallet
	 *
	 * Remove Wallet | Exemplo: api/v1/wallets/delete/1
	 * 
	 * @param number $wal_id
	 * 
	 * @return int
	 */
	public function delete($wal_id)
	{
		$wallet = Wallets::where('wal_id', $wal_id)->firstOrFail();
		
		if($wallet)
		{
			$wallet->delete();
		}
	}
}

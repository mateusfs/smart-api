<?php

namespace App\Http\Controllers;
use App\Wallet;
use Illuminate\Http\Request;
use App\Repositories\WalletRepository;
use GuzzleHttp\Psr7\Response;

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
	    return WalletRepository::create($request);
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
	    return WalletRepository::update($request);
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
		
		if($wallet)
		{
		    return WalletRepository::delete($wallet);
		}
	}
}

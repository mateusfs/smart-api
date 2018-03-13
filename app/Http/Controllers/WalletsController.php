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
     * Buscar Wallet
     *
     * Buscar Wallet | Exemplo: api/v1/wallets/1
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
	 * Criar Wallet
	 *
	 * Criar Wallet | Exemplo: api/v1/wallets/criar
	 * 
	 * @return void
	 */
	public function criar(Request $request)
	{
	    return Wallets::created($request);
	}
	
	/**
	 * Atualizar Wallet
	 *
	 * Atualizar Wallet | Exemplo: api/v1/wallets/atualizar
	 *
	 * @return void
	 */
	public function atualizar(Request $request)
	{
		return Wallets::updated($request);
	}
	
	
	/**
	 * Remover Wallet
	 *
	 * Remover Wallet | Exemplo: api/v1/wallets/delete/1
	 * 
	 * @param number $wal_id
	 * 
	 * @return int
	 */
	public function delete($wal_id)
	{
		$wallet = Wallets::where('wal_id', $wal_id)->firstOrFail();
		if($wallet){
			$wallet->delete();
		}
	}
}

<?php

namespace App\Repositories;

use App\Wallet;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\WalletRequest;

class WalletRepository
{
    /**
     * Create a new wallet post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Wallet::created($request);
        }

        return response()->json(["error" => "Problems creating a wallet"], 403);
    }

    /**
     * Update a new wallet post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Wallet::saved($request);
        }

        return response()->json(["error" => "Problems updating a wallet"], 403);
    }

    /**
     * Delete a wallet.
     *
     * @param  $wallet
     * @return Response
     */
    public function delete(Wallet $wallet)
    {
        if($wallet)
        {
            return $wallet->delete();
        }

        return response()->json(["error" => "Problems deleting a wallet"], 403);
    }

    /**
     * Status a wallet.
     *
     * @param  Request  $data
     * @return true
     */
    public function status()
    {

    }


    /**
     * Validade a wallet.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, WalletRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }


    



}

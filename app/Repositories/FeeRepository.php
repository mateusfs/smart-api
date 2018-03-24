<?php

namespace App\Repositories;

use App\Fee;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class FeeRepository
{
	
    /**
     * Create a new fee post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
        	return Fee::create($request);
        }

        return response()->json(["error" => "Problems creating a fee"], 403);
    }

    /**
     * Update a new fee post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Fee::save($request);
        }

        return response()->json(["error" => "Problems updating a fee"], 403);
    }

    /**
     * Delete a fee.
     *
     * @param  $request
     * @return Response
     */
    public function delete(Fee $fee)
    {
        if($fee)
        {
            return $fee->delete();
        }
        return response()->json(["error" => "Problems deleting a fee"], 403);
    }

    /**
     * Status of fee.
     *
     * @return string
     */
    public function status()
    {
        // open, partial, paid
    }

    /**
     * Expired of fee.
     *
     * @param  $fee
     * @return true/false
     */
    public function expired()
    {

    }

    /**
     * Accept after of fee.
     *
     * @param  $fee
     * @return true/false
     */
    public function acceptAfter()
    {

    }

    /**
     * Calcule expired fee of fee.
     *
     * @param  $fee
     * @return true
     */
    public function calcExpiredFee()
    {
        //if acceptAfter()

    }

    /**
     * Validate a fee.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, FeeRepository::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

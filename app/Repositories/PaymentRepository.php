<?php

namespace App\Repositories;

use App\Receivable;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class PaymentRepository
{
	
    /**
     * Create a new payment post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
        	return Receivable::create($request);
        }

        return response()->json(["error" => "Problems creating a payment"], 403);
    }

    /**
     * Update a new payment post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
        	return Receivable::save($request);
        }

        return response()->json(["error" => "Problems updating a payment"], 403);
    }

    /**
     * Delete a payment.
     *
     * @param  $receivable
     * @return Response
     */
    public function delete(Receivable $receivable)
    {
    	if($receivable)
        {
        	return $receivable->delete();
        }

        return response()->json(["error" => "Problems deleting a payment"], 403);
    }

    /**
     * Status a payment.
     *
     * @param  $payment
     * @return string
     */
    public function status($payment)
    {
       //true false
    }

    /**
     * Avaliable a payment.
     *
     * @param  $payment
     * @return true/false
     */
    public function avaliable()
    {
        // disponivel true/false
    }

    /**
     * Validade a payment.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, PaymentRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

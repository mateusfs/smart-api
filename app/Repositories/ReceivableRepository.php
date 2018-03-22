<?php

namespace App\Repositories;

use App\Receivable;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\ReceivableRequest;

class ReceivableRepository
{

	/**
     * Create a new receivable post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
        	return Receivable::create($request);
        }

        return response()->json(["error" => "Problems creating a receivable"], 403);
    }

    /**
     * Update a new receivable post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
        	return Receivable::save($request);
        }

        return response()->json(["error" => "Problems updating a receivable"], 403);
    }

    /**
     * Delete a receivable.
     *
     * @param  $request
     * @return Response
     */
    public function delete(Receivable $receivable)
    {
    	if($receivable)
        {
        	return $receivable->delete();
        }

        return response()->json(["error" => "Problems deleting a receivable"], 403);
    }

    /**
     * Status a receivable.
     *
     * @param  $receivable
     * @return string
     */
    public function status($receivable)
    {
       //true false
    }

    /**
     * Avaliable a receivable.
     *
     * @param  Request  $receivable
     * @return true/false
     */
    public function avaliable($receivable)
    {
        // disponivel true/false
    }

    /**
     * Validade a receivable.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, ReceivableRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }


}

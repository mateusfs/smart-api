<?php

namespace App\Repositories;

use App\Intermediator;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\IntermediatorMethodRequest;

class IntermediatorMethodRepository
{

     /**
     * Create a new method intermediator post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Intermediator::create($request);
        }

        return response()->json(["error" => "Problems creating a method intermediator"], 403);
    }

    /**
     * Update a new method intermediator post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Intermediator::save($request);
        }

        return response()->json(["error" => "Problems updating a method intermediator"], 403);
    }

    /**
     * Delete a method intermediator.
     *
     * @param  $request
     * @return Response
     */
    public function delete(Intermediator $intermediator)
    {
        if($intermediator)
        {
            return $intermediator->delete();
        }
        return response()->json(["error" => "Problems deleting a method intermediator"], 403);
    }

    /**
     * Status a method intermediator.
     *
     * @return string
     */
    public function status()
    {

    }

    /**
     * Paid a method intermediator.
     *
     * @return string
     */
    public function paid()
    {

    }

    
    /**
     * Validate a method intermediator.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, IntermediatorMethodRequest::rules());
    	
    	if ($v->fails())
    	{
    		return $v->errors;
    	}
    	
    	return true;
    }
    
   
}

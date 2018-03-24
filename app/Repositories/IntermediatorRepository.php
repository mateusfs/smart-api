<?php

namespace App\Repositories;

use App\Intermediator;
use App\Http\Requests\IntermediatorRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class IntermediatorRepository
{
	/**
	 * Rules intermediator
	 */
	protected $rules = [
			'int_title' => 'required'
	];
	
	
     /**
     * Create a new intermediator post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Intermediator::create($request);
        }

        return response()->json(["error" => "Problems creating a intermediator"], 403);
    }

    /**
     * Update a new intermediator post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Intermediator::save($request);
        }

        return response()->json(["error" => "Problems updating a intermediator"], 403);
    }

    /**
     * Delete a intermediator.
     *
     * @param  $intermediator
     * @return Response
     */
    public function delete(Intermediator $intermediator)
    {
        if($intermediator)
        {
            return $intermediator->delete();
        }
        return response()->json(["error" => "Problems deleting a intermediator"], 403);
    }

    /**
     * Status a intermediator.
     *
     * @return string
     */
    public function status()
    {

    }

    /**
     * Paid a intermediator.
     *
     * @return string
     */
    public function paid()
    {

    }
    
    /**
     * Validate a item.
     *
     * @param  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, IntermediatorRequest::rules());
    	
    	if ($v->fails())
    	{
    		return $v->errors;
    	}
    	
    	return true;
    }
}

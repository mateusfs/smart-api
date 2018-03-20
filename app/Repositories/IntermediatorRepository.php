<?php

namespace App\Repositories;

use GuzzleHttp\Psr7\Response;
use App\Intermediator;

class IntermediatorRepository
{
     /**
     * Create a new intermediator post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Intermediator::created($request);
        }

        return response()->json(["error" => "Problems creating a intermediator"], 403);
    }

    /**
     * Update a new intermediator post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Intermediator::saved($request);
        }

        return response()->json(["error" => "Problems updating a intermediator"], 403);
    }

    /**
     * Delete a intermediator.
     *
     * @param  Request  $request
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

}

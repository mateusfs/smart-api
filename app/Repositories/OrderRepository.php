<?php

namespace App\Repositories;

use App\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class OrderRepository
{
    /**
     * Create a new order post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Order::create($request);
        }

        return response()->json(["error" => "Problems creating a order"], 403);
    }


    /**
     * Update a new order post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
    	if($this->validate($request) == true){
    		return Order::save($request);
        }

        return response()->json(["error" => "Problems updating a order"], 403);
    }

    /**
     * Delete a order.
     *
     * @param  $order
     * @return Response
     */
    public function delete(Order $order)
    {
        if($order)
        {
            return $order->delete();
        }
        return response()->json(["error" => "Problems deleting a order"], 403);
    }

    /**
     * Status a order.
     *
     * @param  $order
     * @return string
     */
    public function status()
    {

    }

    /**
     * Validade a order.
     *
     * @param  $data
     * @return true/false
     */
    public function validate($data)
    {
    	$v = Validator::make($data, OrderRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

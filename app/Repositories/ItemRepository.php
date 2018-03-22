<?php

namespace App\Repositories;

use App\Item;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Http\Requests\ItemRequest;

class ItemRepository
{
	
    /**
     * Create a new Item post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Item::create($request);
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
            return Item::save($request);
        }

        return response()->json(["error" => "Problems updating a order"], 403);
    }

    /**
     * Delete a item.
     *
     * @param  $request
     * @return Response
     */
    public function delete(Item $item)
    {
        if($order)
        {
            return $order->delete();
        }
        return response()->json(["error" => "Problems deleting a item"], 403);
    }

    /**
     * Status a item.
     *
     * @param  $item
     * @return string
     */
    public function status()
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
    	$v = Validator::make($data, ItemRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

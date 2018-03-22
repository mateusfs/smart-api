<?php

namespace App\Repositories;

use App\Item;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class ItemRepository
{
	
	/**
	 * Rules Item
	 */
	protected $rules = [
			'oit_pedido' => 'required',
			'oit_titulo' => 'required',
			'oit_tipo' => 'required',
			'oit_tipo_id' => 'required',
			'oit_quantidade' => 'required',
			'oit_valor'=> 'required'
	];
	
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
        $v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

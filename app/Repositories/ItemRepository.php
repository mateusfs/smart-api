<?php

namespace App\Repositories;

use App\Item;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class ItemRepository
{
    /**
     * Create a new Item post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Item::created($request);
        }

        return response()->json(["error" => "Problems creating a order"], 403);
    }


    /**
     * Update a new order post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Item::saved($request);
        }

        return response()->json(["error" => "Problems updating a order"], 403);
    }

    /**
     * Delete a item.
     *
     * @param  Request  $request
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
     * @param  Request  $item
     * @return string
     */
    public function status()
    {

    }

    /**
     * Validate a item.
     *
     * @param  Request  $data
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


    protected $rules = [
        'oit_pedido' => 'required',
        'oit_titulo' => 'required',
        'oit_tipo' => 'required',
        'oit_tipo_id' => 'required',
        'oit_quantidade' => 'required',
        'oit_valor'=> 'required'
    ];

}

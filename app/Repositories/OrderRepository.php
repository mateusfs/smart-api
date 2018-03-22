<?php

namespace App\Repositories;

use App\Order;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class OrderRepository
{
	/**
	 * Rules Order
	 */
	protected $rules = [
			'ord_carteira' => 'required',
			'ord_aceitar_boleto' => 'required',
			'ord_aceitar_cartao' => 'required',
			'ord_aceitar_cartao_parcelas' => 'required',
			'ord_status' => 'required',
			'ord_emails' => 'required',
			'ord_pagamento_minimo' => 'required',
			'ord_criado_em' => 'required',
			'ord_atualizar' => 'required',
			'ord_vencimento' => 'required',
			'ord_receber_ate' => 'required',
			'ord_multa_atraso' => 'required',
			'ord_juros_dia' => 'required',
			'ord_entrega' => 'required',
			'ord_nome' => 'required',
			'ord_email' => 'required',
			'ord_celular' => 'required'
	];
	
    /**
     * Create a new order post.
     *
     * @param  $request
     * @return Response
     */
    public function create(Request $request)
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
        $v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }

}

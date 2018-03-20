<?php

namespace App\Repositories;

use App\Payment;
use GuzzleHttp\Psr7\Response;
use Illuminate\Validation\Validator;

class PaymentRepository
{

    /**
     * Create a new payment post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Payment::created($request);
        }

        return response()->json(["error" => "Problems creating a payment"], 403);
    }

    /**
     * Update a new payment post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Payment::saved($request);
        }

        return response()->json(["error" => "Problems updating a payment"], 403);
    }

    /**
     * Delete a payment.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete(Payment $payment)
    {
        if($payment)
        {
           return $payment->delete();
        }

        return response()->json(["error" => "Problems deleting a payment"], 403);
    }

    /**
     * Status a payment.
     *
     * @param  Request  $payment
     * @return string
     */
    public function status()
    {
       //true false
    }

    /**
     * Avaliable a payment.
     *
     * @param  Request  $payment
     * @return true/false
     */
    public function avaliable()
    {
        // disponivel true/false
    }

    /**
     * Validade a payment.
     *
     * @param  Request $data
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
		'prc_local' => 'required',
		'prc_carteira' => 'required',
		'prc_pagamento' => 'required',
        'prc_valor' => 'required',
        'prc_numero' => 'required',
        'prc_disponivel_em' => 'required',
		'prc_disponibilizada' => 'required',
        'prc_status' => 'required',
		'prc_intermediario_taxa' => 'required',
		'prc_empresa' => 'required',
        'prc_cliente' => 'required',
    ];
}

<?php

namespace App\Repositories;

use App\Withdrawal;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Parameter;
use App\Gerencianet;
use App\Iugu;
use App\Http\Requests\WithdrawalRequest;

class WithdrawalRepository
{
	/**
     * Create a new withdrawal post.
     *
     * @param  $request
     * @return Response
     */
    public function create($request)
    {
        if($this->validate($request) == true){
            return Withdrawal::create($request);
        }

        return response()->json(["error" => "Problems creating a withdrawal"], 403);
    }

    /**
     * Update a new withdrawal post.
     *
     * @param  $request
     * @return Response
     */
    public function update($request)
    {
        if($this->validate($request) == true){
            return Withdrawal::save($request);
        }

        return response()->json(["error" => "Problems updating a withdrawal"], 403);
    }

    /**
     * Delete a withdrawal.
     *
     * @param  $withdrawal
     * @return Response
     */
    public function delete(Withdrawal $withdrawal)
    {
        if($withdrawal)
        {
            return $withdrawal->delete();
        }
        return response()->json(["error" => "Problems deleting a withdrawal"], 403);
    }

    /**
     * Delete a withdrawal.
     *
     * @param  $method
     * @param  $data_ini
     * @param  $data_fin
     * @return Response
     */
    public function calcReceivables($method='total',$data_ini=null,$data_fin=null)
    {
        // disponivel e futuros
    }

    /**
     * Calule fees of withdrawal.
     *
     * @param  $to
     * @return Response
     */
    public function calcFeesTo($to='intermadiator')
    {
        // intermadiator | system
    }

    /**
     * Calcule balance of withdrawal.
     *
     * @param  $who
     * @return Response
     */
    public function calcBalance($who='owner')
    {

    }

    /**
     * Verify of withdrawal.
     *
     * @param  $withdraw
     * @return Response
     */
    public function withDraw(Withdrawal $withdraw)
    {
        // verificar saldo dele(cliente)
        // automatizar o saque

        if($withdraw)
        {
            if(Parameter::getIsIugu())
            {
                $customVariables = Iugu::getCustonVariables($withdraw->saq_intermediario, $withdraw->saq_valor);

                $subAccount = Iugu::orderOfWithdrawal($withdraw->saq_intermediario, null);

                if($subAccount)
                {
                    $result = Iugu::requestWithdrawal($subAccount['account_id'], $withdraw->saq_valor, $customVariables);
                }
            }

            if(Parameter::getIsGerenciaNet())
            {
                $result = Gerencianet::createTransaction($withdraw->saq_intermediario, 1, $withdraw->saq_valor);
            }

        }

        if($result)
        {
            return $result;
        }

        return response()->json(["error" => "Problems withdraw"], 403);
    }


    /**
     * Validade a withdrawal.
     *
     * @param  Request  $data
     * @return true
     */
    public function validate($data)
    {
    	$v = Validator::make($data, WithdrawalRequest::rules());

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }
}

<?php

namespace App\Repositories;

use App\Withdrawal;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;
use App\Parameter;
use App\Gerencianet;
use App\Iugu;

class WithdrawalRepository
{

    /**
     * Create a new withdrawal post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Withdrawal::created($request);
        }

        return response()->json(["error" => "Problems creating a withdrawal"], 403);
    }

    /**
     * Update a new withdrawal post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Withdrawal::saved($request);
        }

        return response()->json(["error" => "Problems updating a withdrawal"], 403);
    }

    /**
     * Delete a withdrawal.
     *
     * @param  Request  $request
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
     * @param  Request  $request
     * @return Response
     */
    public function calcReceivables($method='total',$data_ini=null,$data_fin=null)
    {
        // disponivel e futuros
    }

    /**
     * Calule fees of withdrawal.
     *
     * @param  Request  $request
     * @return Response
     */
    public function calcFeesTo($to='intermadiator')
    {
        // intermadiator | system
    }

    /**
     * Calcule balance of withdrawal.
     *
     * @param  Request  $request
     * @return Response
     */
    public function calcBalance($who='owner')
    {

    }

    /**
     * Verify of withdrawal.
     *
     * @param  Request  $request
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
        $v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
            return $v->errors;
        }

        return true;
    }


    protected $rules = [
        'saq_carteira' => 'required',
        'saq_criado_em' => 'required',
        'saq_valor' => 'required',
        'saq_status' => 'required',
        'saq_intermediario' => 'required',
        'saq_intermediario_code' => 'required',
        'saq_pago_em' => 'required',
    ];




}

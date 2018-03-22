<?php

namespace App\Http\Requests;

class WithdrawalRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        	'saq_carteira' => 'required',
        	'saq_criado_em' => 'required',
        	'saq_valor' => 'required',
        	'saq_status' => 'required',
        	'saq_intermediario' => 'required',
        	'saq_intermediario_code' => 'required',
        	'saq_pago_em' => 'required',
        ];

    }

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function messages()
    {
        return [
        	'saq_carteira' => 'Fill the value of wallet',
        	'saq_criado_em' => 'Fill the value of created',
        	'saq_valor' => 'Fill the value',
        	'saq_status' => 'Fill the value of status',
        	'saq_intermediario' => 'Fill the value of imtermediator',
        	'saq_intermediario_code' => 'Fill the value of code imtermediator',
        	'saq_pago_em' => 'Fill the value of paid in',
        ];
    }

    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function attributes()
    {
        return [
        	'saq_carteira' => 'carteira',
        	'saq_criado_em' => 'criado_em',
        	'saq_valor' => 'valor',
        	'saq_status' => 'status',
        	'saq_intermediario' => 'intermediario',
        	'saq_intermediario_code' => 'intermediario_code',
        	'saq_pago_em' => 'pago_em',
        ];
    }
}
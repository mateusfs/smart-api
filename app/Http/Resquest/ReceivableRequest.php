<?php

namespace App\Http\Requests;

class ReceivableRequest extends BaseRequest
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
       		'prc_carteira' => 'required|min:5|max:100',
       		'prc_pagamento' => 'required',
       		'prc_valor' => 'required',
       		'prc_numero' => 'required',
       		'prc_disponivel_em' => 'required',
       		'prc_disponibilizada' => 'required',
       		'prc_status' => 'required'
        ];

    }
    
    
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Illuminate\Foundation\Http\FormRequest::messages()
	 */
    public function messages()
    {
        return [
        	'prc_carteira.required' => 'Fill the wallet',
        	'prc_pagamento.required' => 'Fill the payment',
        	'prc_valor.required' => 'Fill the value',
        	'prc_numero.required' => 'Fill the number',
        	'prc_disponivel_em.required' => 'Fill the in availeble',
        	'prc_disponibilizada.required' => 'Fill the availeble',
        	'prc_status.required' => 'Fill the status',
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
            'prc_carteira' => 'carteira',
       		'prc_pagamento' => 'pagamento',
       		'prc_valor' => 'valor',
        	'prc_numero' => 'numero',
			'prc_disponivel_em' => 'disponivel_em',
        	'prc_disponibilizada' => 'disponibilizada',
        	'prc_status' => 'status',
        ];
    }
}
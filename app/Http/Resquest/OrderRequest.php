<?php

namespace App\Http\Requests;

class OrderRequest extends BaseRequest
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
        	'ord_carteira' => 'required|min:5|max:100',
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

    }

    /**
     * 
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        return [
        	'ord_carteira.required' => 'Fill the value of',
        	'ord_aceitar_boleto.required' => 'Fill the accept of billet',
        	'ord_aceitar_cartao.required' => 'Fill the accept of card',
        	'ord_aceitar_cartao_parcelas.required' => 'Fill the accept parcels of card',
        	'ord_status.required' => 'Fill the status',
        	'ord_emails.required' => 'Fill the emails',
        	'ord_pagamento_minimo.required' => 'Fill the payment minimun',
        	'ord_criado_em.required' => 'Fill the create',
        	'ord_atualizar.required' => 'Fill the update',
        	'ord_vencimento.required' => 'Fill the due',
        	'ord_receber_ate.required' => 'Fill the ord_receber_ate',
        	'ord_multa_atraso.required' => 'Fill the after fee',
        	'ord_juros_dia.required' => 'Fill the day fee',
        	'ord_entrega.required' => 'Fill the delivery',
        	'ord_nome.required' => 'Fill the name',
        	'ord_email.required' => 'Fill the email',
        	'ord_celular.required' => 'Fill the cellphone',
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
            'ord_carteira' => 'carteira',
            'ord_aceitar_boleto' => 'aceitar_boleto',
       		'ord_aceitar_cartao' => 'aceitar_cartao',
       		'ord_aceitar_cartao_parcelas' => 'aceitar_cartao_parcelas',
        	'ord_status' => 'status',
			'ord_emails' => 'emails',
        	'ord_pagamento_minimo' => 'pagamento_minimo',
        	'ord_criado_em' => 'criado_em',
        	'ord_atualizar' => 'pagamento_minimo',
        	'ord_vencimento' => 'vencimento',
        	'ord_receber_ate' => 'receber_ate',
        	'ord_multa_atraso' => 'multa_atraso',
        	'ord_juros_dia' => 'juros_dia',
        	'ord_entrega' => 'entrega',
        	'ord_nome' => 'nome',
        	'ord_email' => 'email',
        	'ord_celular' => 'celular',
        ];
    }
}
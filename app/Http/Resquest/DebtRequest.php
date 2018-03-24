<?php

namespace App\Http\Requests;

class DebtRequest extends BaseRequest
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
            'dbt_order_id' => 'required|min:1|max:100',
            'dbt_value' => 'required|numeric',
        	'dbt_value_quota' => 'required|numeric',
        	'dbt_value_fee' => 'required|numeric',
        	'dbt_due_at' => 'required|date',
        	'dbt_accept_creditcard' => 'required|numeric',
        	'dbt_accept_billet' => 'required',
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
        	'dbt_value.required' => 'Fill the value of',
        	'dbt_value_quota.required' => 'Fill the value of quota',
        	'value_fee.required' => 'Fill the value of quota',
        	'dbt_due_at.required' => 'Fill the due',
        	'dbt_accept_creditcard.required' => 'Fill the creditcard',
        	'dbt_accept_billet.required' => 'Fill the billet',
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
            'dbt_order_id' => 'order_id',
            'dbt_value' => 'value',
       		'dbt_value_quota' => 'value_quota',
       		'value_fee' => 'value_fee',
        	'dbt_due_at' => 'due_at',
			'dbt_accept_creditcard' => 'accept_creditcard',
        	'dbt_accept_billet' => 'accept_billet',
        ];
    }
}
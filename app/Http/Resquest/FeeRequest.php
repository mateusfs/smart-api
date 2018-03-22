<?php

namespace App\Http\Requests;

class FeeRequest extends BaseRequest
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
            'fee_wallet_id' => 'required|min:5|max:100',
            'fee_debt_id' => 'required|numeric',
        	'fee_payment_id' => 'required|numeric',
        	'fee_datetime' => 'required|numeric',
        	'fee_value' => 'required|date',
        	'fee_created_at' => 'required|numeric',
        	'fee_to' => 'required',
        	'fee_description' => 'required',
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
        	'fee_wallet_id.required' => 'Fill the value of id wallet',
        	'fee_debt_id.required' => 'Fill the value of id debet',
        	'fee_payment_id.required' => 'Fill the value of payment',
        	'fee_datetime.required' => 'Fill the date',
        	'fee_value.required' => 'Fill the value',
        	'fee_created_at.required' => 'Fill the created at',
        	'fee_to.required' => 'Fill the to',
        	'fee_description.required' => 'Fill the description',
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
            'fee_wallet_id' => 'wallet_id',
            'fee_debt_id' => 'debt_id',
       		'fee_payment_id' => 'payment_id',
       		'fee_datetime' => 'datetime',
        	'fee_value' => 'value',
			'fee_created_at' => 'created_at',
        	'fee_to' => 'to',
        	'fee_description' => 'description',
        ];
    }
}
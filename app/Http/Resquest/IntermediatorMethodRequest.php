<?php

namespace App\Http\Requests;

class IntermediatorMethodRequest extends BaseRequest
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
            'imt_intermediator_id' => 'required|min:1|max:100',
            'imt_title' => 'required',
        	'imt_type' => 'required|numeric',
        	'imt_fixed' => 'required|numeric',
        	'imt_variable' => 'required|numeric'
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
        	'imt_title.required' => 'Fill the value of title',
        	'value_fee.required' => 'Fill the value of fee',
        	'imt_type.required' => 'Fill the type',
        	'imt_fixed.required' => 'Fill the fixed',
        	'imt_variable.required' => 'Fill the variable',
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
            'imt_intermediator_id' => 'intermediator_id',
            'imt_title' => 'title',
       		'imt_type' => 'type',
       		'imt_fixed' => 'fixed',
        	'imt_variable' => 'variable'
        ];
    }
}
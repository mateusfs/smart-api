<?php

namespace App\Http\Requests;

class IntermediatorRequest extends BaseRequest
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
            'int_id' => 'required|min:5|max:100',
            'int_title' => 'required',
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
        	'int_title.required' => 'Fill the value of title'
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
            'int_id' => 'id',
            'int_title' => 'title'
        ];
    }
}
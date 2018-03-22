<?php

namespace App\Http\Requests;

class ItemRequest extends BaseRequest
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
        	'oit_pedido' => 'required|min:5|max:100',
        	'oit_titulo' => 'required',
        	'oit_tipo' => 'required',
        	'oit_tipo_id' => 'required',
        	'oit_quantidade' => 'required',
        	'oit_valor'=> 'required'
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
        	'oit_pedido.required' => 'Fill the order',
        	'oit_titulo.required' => 'Fill the title',
        	'oit_tipo.required' => 'Fill the type',
        	'oit_tipo_id.required' => 'Fill the type id',
        	'oit_quantidade.required' => 'Fill the quantity',
        	'oit_valor.required' => 'Fill the value',
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
            'oit_pedido' => 'pedido',
            'oit_titulo' => 'titulo',
       		'oit_tipo' => 'tipo',
       		'oit_tipo_id' => 'tipo_id',
        	'oit_quantidade' => 'quantidade',
			'oit_valor' => 'valor',
        ];
    }
}
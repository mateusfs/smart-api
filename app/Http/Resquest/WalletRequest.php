<?php

namespace App\Http\Requests;

class WalletRequest extends BaseRequest
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
       		'wal_title' => 'required|min:5|max:100',
      		'wal_key' => 'required',
       		'wal_secret' => 'required',
       		'wal_pin' => 'required',
       		'wal_saque_automatico' => 'required',
       		'wal_multas' => 'required',
       		'wal_antecipacao' => 'required',
       		'wal_antecipacao_tipo' => 'required',
       		'wal_antecipacao_dias' => 'required',
       		'wal_soft_descriptor' => 'required',
       		'wal_pacelamento_max' => 'required',
       		'wal_aceitar_boleto' => 'required',
       		'wal_aceitar_cartao' => 'required',
       		'wal_cartao_comissao_taxa' => 'required',
       		'wal_cartao_comissao_fixo' => 'required',
       		'wal_taxa_cartao_antecipacao' => 'required',
       		'wal_banco' => 'required',
       		'wal_agencia' => 'required',
       		'wal_conta' => 'required',
       		'wal_intermediary' => 'required',
       		'wal_intermediary_settings' => 'required'
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
        	'wal_title.required' => 'Fill the value of',
        	'wal_key' => 'Fill the key',
        	'wal_secret' => 'Fill the secret',
        	'wal_pin' => 'Fill the pin',
        	'wal_saque_automatico' => 'Fill the automatic withdrawal',
        	'wal_multas' => 'Fill the taxes',
        	'wal_antecipacao' => 'Fill the anticipation',
        	'wal_antecipacao_tipo' => 'Fill the type of anticipation',
        	'wal_antecipacao_dias' => 'Fill the days of anticipation',
        	'wal_soft_descriptor' => 'Fill the soft descriptor',
        	'wal_pacelamento_max' => 'Fill the maximum installment',
        	'wal_aceitar_boleto' => 'Fill the accept of billet',
        	'wal_aceitar_cartao' => 'Fill the aceept of card',
        	'wal_cartao_comissao_taxa' => 'Fill the card fee',
        	'wal_cartao_comissao_fixo' => 'Fill the card tax',
        	'wal_taxa_cartao_antecipacao' => 'Fill the tax of anticipation',
        	'wal_banco' => 'Fill the bank',
        	'wal_agencia' => 'Fill the agency',
        	'wal_conta' => 'Fill the acount',
        	'wal_intermediary' => 'Fill the intermediary',
        	'wal_intermediary_settings' => 'Fill the intermediary of settings'
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
        	'wal_title' => 'title',
        	'wal_key' => 'key',
        	'wal_secret' => 'secret',
        	'wal_pin' => 'pin',
        	'wal_saque_automatico' => 'saque_automatico',
        	'wal_multas' => 'multas',
        	'wal_antecipacao' => 'antecipacao',
        	'wal_antecipacao_tipo' => 'antecipacao_tipo',
        	'wal_antecipacao_dias' => 'antecipacao_dias',
        	'wal_soft_descriptor' => 'soft_descriptor',
        	'wal_pacelamento_max' => 'pacelamento_max',
        	'wal_aceitar_boleto' => 'aceitar_boleto',
        	'wal_aceitar_cartao' => 'aceitar_cartao',
        	'wal_cartao_comissao_taxa' => 'cartao_comissao_taxa',
        	'wal_cartao_comissao_fixo' => 'cartao_comissao_fixo',
        	'wal_taxa_cartao_antecipacao' => 'taxa_cartao_antecipacao',
        	'wal_banco' => 'banco',
        	'wal_agencia' => 'agencia',
        	'wal_conta' => 'conta',
        	'wal_intermediary' => 'intermediary',
        	'wal_intermediary_settings' => 'intermediary_settings'
        ];
    }
}
<?php

namespace App\Http\Requests;

class PaymentRequest extends BaseRequest
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
       		'pgm_id' => 'required|min:5|max:100',
        	'pgm_local' => 'required',
        	'pgm_carteira' => 'required',
        	'pgm_pedido' => 'required',
        	'pgm_valor' => 'required',
        	'pgm_parcelas' => 'required',
        	'pgm_parcelas_pagas' => 'required',
        	'pgm_pagador_nome' => 'required',
        	'pgm_pagador_email' => 'required',
        	'pgm_pagador_celular' => 'required',
        	'pgm_pagador_cpf' => 'required',
        	'pgm_pagador_genero' => 'required',
        	'pgm_pagador_nascimento' => 'required',
        	'pgm_pagador_razao' => 'required',
        	'pgm_pagador_cnpj' => 'required',
        	'pgm_metodo' => 'required',
        	'pgm_intermediario' => 'required',
        	'pgm_intermediario_code' => 'required',
        	'pgm_intermediario_status' => 'required',
        	'pgm_intermediario_taxa' => 'required',
        	'pgm_intermediario_fixo' => 'required',
        	'pgm_intermediario_variavel' => 'required',
        	'pgm_intermediario_total' => 'required',
        	'pgm_intermediario_disponivel' => 'required',
        	'pgm_boleto_url' => 'required',
        	'pgm_boleto_digitavel' => 'required',
        	'pgm_cartao_metodo' => 'required',
        	'pgm_cartao_bandeira' => 'required',
        	'pgm_cartao_numero' => 'required',
        	'pgm_cartao_mes' => 'required',
        	'pgm_cartao_ano' => 'required',
        	'pgm_cartao_nome' => 'required',
        	'pgm_cartao_codigo' => 'required',
        	'pgm_cartao_recobrancas' => 'required',
        	'pgm_endereco_cep' => 'required',
        	'pgm_endereco_cidade' => 'required',
        	'pgm_endereco_logradouro' => 'required',
        	'pgm_endereco_numero' => 'required',
        	'pgm_endereco_bairro' => 'required',
        	'pgm_endereco_complemento' => 'sometimes',
        	'pgm_comissao_custo' => 'sometimes',
        	'pgm_comissao_taxa' => 'sometimes',
        	'pgm_comissao_fixo' => 'sometimes',
        	'pgm_comissao_variavel' => 'sometimes',
        	'pgm_comissao_total' => 'sometimes',
        	'pgm_comissao_paga' => 'sometimes',
        	'pgm_criado_em' => 'sometimes',
        	'pgm_pago_em' => 'sometimes',
        	'pgm_cliente_taxa' => 'sometimes',
        	'pgm_cliente_liquido' => 'sometimes',
        	'pgm_disponivel_futuro' => 'sometimes',
        	'pgm_disponivel_liberado' => 'sometimes',
        	'pgm_disponivel_intermediario' => 'sometimes',
        	'pgm_disponivel_empresa' => 'sometimes',
        	'pgm_disponivel_cliente' => 'sometimes',
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
        	'pgm_local' => 'Fill the local',
        	'pgm_carteira' => 'Fill the wallet',
        	'pgm_pedido' => 'Fill the order',
        	'pgm_valor' => 'Fill the value',
        	'pgm_parcelas' => 'Fill the parcels',
        	'pgm_parcelas_pagas' => 'Fill the parcels pay',
        	'pgm_pagador_nome' => 'Fill the name payer',
        	'pgm_pagador_email' => 'Fill the payer email',
        	'pgm_pagador_celular' => 'Fill the payer cellphone',
        	'pgm_pagador_cpf' => 'Fill the payer cpf',
        	'pgm_pagador_genero' => 'Fill the payer genre',
        	'pgm_pagador_nascimento' => 'Fill the payer day borth',
        	'pgm_pagador_razao' => 'Fill the payer reason',
        	'pgm_pagador_cnpj' => 'Fill the payer cnpj',
        	'pgm_metodo' => 'Fill the method',
        	'pgm_intermediario' => 'Fill the intermediary',
        	'pgm_intermediario_code' => 'Fill the code intermediary',
        	'pgm_intermediario_status' => 'Fill the status intermediary',
        	'pgm_intermediario_taxa' => 'Fill the tax intermediary',
        	'pgm_intermediario_fixo' => 'Fill the fix intermediary',
        	'pgm_intermediario_variavel' => 'Fill the variable intermediary',
        	'pgm_intermediario_total' => 'Fill the all of intermediary',
        	'pgm_intermediario_disponivel' => 'Fill the available intermediary',
        	'pgm_boleto_url' => 'Fill the billet url',
        	'pgm_boleto_digitavel' => 'Fill the billet digitable',
        	'pgm_cartao_metodo' => 'Fill the card method',
        	'pgm_cartao_bandeira' => 'Fill the brand card',
        	'pgm_cartao_numero' => 'Fill the number card',
        	'pgm_cartao_mes' => 'Fill the month card',
        	'pgm_cartao_ano' => 'Fill the year card',
        	'pgm_cartao_nome' => 'Fill the name card',
        	'pgm_cartao_codigo' => 'Fill the code card',
        	'pgm_cartao_recobrancas' => 'Fill the card recoveries',
        	'pgm_endereco_cep' => 'Fill the code address',
        	'pgm_endereco_cidade' => 'Fill the city address',
        	'pgm_endereco_logradouro' => 'Fill the logradouro address',
        	'pgm_endereco_numero' => 'Fill the number address',
        	'pgm_endereco_bairro' => 'Fill the neighborhood address',
        	'pgm_endereco_complemento' => 'Fill the complement address',
        	'pgm_comissao_custo' => 'Fill the commission cost',
        	'pgm_comissao_taxa' => 'Fill the commission tax',
        	'pgm_comissao_fixo' => 'Fill the commission fix',
        	'pgm_comissao_variavel' => 'Fill the commission variable',
        	'pgm_comissao_total' => 'Fill the commission all',
        	'pgm_comissao_paga' => 'Fill the commission pay',
        	'pgm_criado_em' => 'Fill the created',
        	'pgm_pago_em' => 'Fill the pay at',
        	'pgm_cliente_taxa' => 'Fill the tax client',
        	'pgm_cliente_liquido' => 'Fill the liquid client',
        	'pgm_disponivel_futuro' => 'Fill the future avaleble',
        	'pgm_disponivel_liberado' => 'Fill the free available',
        	'pgm_disponivel_intermediario' => 'Fill the intermeator available',
        	'pgm_disponivel_empresa' => 'Fill the available company',
        	'pgm_disponivel_cliente' => 'Fill the available client',
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
        	'pgm_id' => 'id',
        	'pgm_local' => 'local',
        	'pgm_carteira' => 'carteira',
        	'pgm_pedido' => 'pedido',
        	'pgm_valor' => 'valor',
        	'pgm_parcelas' => 'parcelas',
        	'pgm_parcelas_pagas' => 'parcelas_pagas',
        	'pgm_pagador_nome' => 'pagador_nome',
        	'pgm_pagador_email' => 'pagador_email',
        	'pgm_pagador_celular' => 'pagador_celular',
        	'pgm_pagador_cpf' => 'pagador_cpf',
        	'pgm_pagador_genero' => 'pagador_genero',
        	'pgm_pagador_nascimento' => 'pagador_nascimento',
        	'pgm_pagador_razao' => 'pagador_razao',
        	'pgm_pagador_cnpj' => 'pagador_cnpj',
        	'pgm_metodo' => 'metodo',
        	'pgm_intermediario' => 'intermediario',
        	'pgm_intermediario_code' => 'intermediario_code',
        	'pgm_intermediario_status' => 'intermediario_status',
        	'pgm_intermediario_taxa' => 'intermediario_taxa',
        	'pgm_intermediario_fixo' => 'intermediario_fixo',
        	'pgm_intermediario_variavel' => 'intermediario_variavel',
        	'pgm_intermediario_total' => 'intermediario_total',
        	'pgm_intermediario_disponivel' => 'intermediario_disponivel',
        	'pgm_boleto_url' => 'boleto_url',
        	'pgm_boleto_digitavel' => 'boleto_digitavel',
        	'pgm_cartao_metodo' => 'cartao_metodo',
        	'pgm_cartao_bandeira' => 'cartao_bandeira',
        	'pgm_cartao_numero' => 'cartao_numero',
        	'pgm_cartao_mes' => 'cartao_mes',
        	'pgm_cartao_ano' => 'cartao_ano',
        	'pgm_cartao_nome' => 'cartao_nome',
        	'pgm_cartao_codigo' => 'cartao_codigo',
        	'pgm_cartao_recobrancas' => 'cartao_recobrancas',
        	'pgm_endereco_cep' => 'endereco_cep',
        	'pgm_endereco_cidade' => 'endereco_cidade',
        	'pgm_endereco_logradouro' => 'endereco_logradouro',
        	'pgm_endereco_numero' => 'endereco_numero',
        	'pgm_endereco_bairro' => 'endereco_bairro',
        	'pgm_endereco_complemento' => 'endereco_complemento',
        	'pgm_comissao_custo' => 'comissao_custo',
        	'pgm_comissao_taxa' => 'comissao_taxa',
        	'pgm_comissao_fixo' => 'comissao_fixo',
        	'pgm_comissao_variavel' => 'comissao_variavel',
        	'pgm_comissao_total' => 'comissao_total',
        	'pgm_comissao_paga' => 'comissao_paga',
        	'pgm_criado_em' => 'criado_em',
        	'pgm_pago_em' => 'pago_em',
        	'pgm_cliente_taxa' => 'cliente_taxa',
        	'pgm_cliente_liquido' => 'cliente_liquido',
        	'pgm_disponivel_futuro' => 'disponivel_futuro',
        	'pgm_disponivel_liberado' => 'disponivel_liberado',
        	'pgm_disponivel_intermediario' => 'disponivel_intermediario',
        	'pgm_disponivel_empresa' => 'disponivel_empresa',
        	'pgm_disponivel_cliente' => 'disponivel_cliente',
        ];
    }
}
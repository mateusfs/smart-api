<?php

namespace App\Repositories;

use App\Debt;
use Gerencianet\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Validation\Validator;

class DebtRepository
{
    /**
     * Create a new debt post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Debt::created($request);
        }
        
        return response()->json(["error" => "Problems creating a debt"], 403);
    }
    
    /**
     * Update a new debt post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Debt::saved($request);
        }
        
        return response()->json(["error" => "Problems updating a debt"], 403);
    }
    
    /**
     * Delete a debt.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete(Debt $debt)
    {
        if($debt)
        {
            return $debt->delete();
        }
        return response()->json(["error" => "Problems deleting a debt"], 403);
    }
    
    /**
     * Status of debt.
     *
     * @param  Request  $debt
     * @return string
     */
    public function status()
    {
        // open, partial, paid
    }

    /**
     * Paid of debt.
     *
     * @param  Request  $debt
     * @return true/false
     */
    public function paid()
    {

    }

    /**
     * Installments open of debt.
     *
     * @param  Request  $debt
     * @return true/false
     */
    public function installmentsOpen()
    {

    }

    /**
     * Installments paid of debt.
     *
     * @param  Request  $debt
     * @return true/false
     */
    public function installmentsPaid()
    {

    }

    /**
     * Expired of debt.
     *
     * @param  Request  $debt
     * @return true/false
     */
    public function expired()
    {

    }

    /**
     * Accept after of debt.
     *
     * @param  Request  $debt
     * @return true/false
     */
    public function acceptAfter()
    {
        
    }

    /**
     * Calcule expired fee of debt.
     *
     * @param  Request  $debt
     * @return true
     */
    public function calcExpiredFee()
    {
        //if acceptAfter()

    }
    
    /**
     * Validate a debt.
     *
     * @param  Request  $data
     * @return true
     */
    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);
        
        if ($v->fails())
        {
            return $v->errors;
        }
        
        return true;
    }
    
    
    protected $rules = [
        'pgm_local' => 'required',
        'pgm_carteira' => 'required',
        'pgm_pedido' => 'required',
        'pgm_valor' => 'required',
        'pgm_parcelas' => 'required',
        'pgm_parcelas_pagas' => 'required',
        'pgm_status' => 'required',
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
        'pgm_endereco_estado' => 'required',
        'pgm_endereco_logradouro' => 'required',
        'pgm_endereco_numero' => 'required',
        'pgm_endereco_bairro' => 'required',
        'pgm_endereco_complemento' => 'required',
        'pgm_comissao_custo' => 'required',
        'pgm_comissao_taxa' => 'required',
        'pgm_comissao_fixo' => 'required',
        'pgm_comissao_variavel' => 'required',
        'pgm_comissao_total' => 'required',
        'pgm_comissao_paga' => 'required',
        'pgm_criado_em' => 'required',
        'pgm_pago_em' => 'required',
        'pgm_cliente_taxa' => 'required',
        'pgm_cliente_liquido' => 'required',
        'pgm_disponivel_futuro' => 'required',
        'pgm_disponivel_liberado' => 'required',
        'pgm_disponivel_intermediario' => 'required',
        'pgm_disponivel_empresa' => 'required',
        'pgm_disponivel_cliente' => 'required',
        'pgm_id_cliente_iugu' => 'required',
        'pgm_id_cliente_gerencia_net'  => 'required'
    ];

}

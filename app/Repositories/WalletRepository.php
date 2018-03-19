<?php

namespace App\Repositories;

use App\Wallet;
use Gerencianet\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Validation\Validator;

class WalletRepository
{
    
    /**
     * Create a new wallet post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        if($this->validate($request) == true){
            return Wallet::created($request);
        }
        
        return response()->json(["error" => "Problems creating a wallet"], 403);
    }
    
    /**
     * Update a new wallet post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        if($this->validate($request) == true){
            return Wallet::saved($request);
        }
        
        return response()->json(["error" => "Problems updating a wallet"], 403);
    }
    
    /**
     * Delete a wallet.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete(Wallet $wallet)
    {
        if($wallet)
        {
            return $wallet->delete();
        }
        
        return response()->json(["error" => "Problems deleting a wallet"], 403);
    }

    /**
     * Status a wallet.
     *
     * @param  Request  $data
     * @return true
     */
    public function status()
    {
        
    }


    /**
     * Validade a wallet.
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
        'wal_title' => 'required',
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
        'pes_senha' => 'required',
        'wal_intermediary' => 'required',
        'wal_intermediary_settings' => 'required'
    ];
    



}

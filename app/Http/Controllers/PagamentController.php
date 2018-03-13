<?php
namespace App\Http\Controllers;

use App\Dividas;
use App\Parametros;
use App\Iugu;
use App\Gerencianet;

/**
 * @resource Pagament
 */
class PagamentController extends Controller
{

    /**
     * Gerar Pagament por Boleto
     *
     * Gerar um boleto | Exemplo: api/v1/pagament/boleto/$pgm_id
     */
    public function gerarPagamentBoleto($pgm_id)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($divida) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::emetirBoleto($divida);
            }
            
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::emetirBoleto($divida);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da divida é obrigatório"], 403);
    }
    
    
    
    
    
    /**
     * Gerar Pagament por boleto pessoa juridica
     *
     * Gerar um boleto | Exemplo: api/v1/pagament/boleto/pessoaJuridica/$pgm_id
     */
    public function gerarPagamentBoletoPessoaJuridica($pgm_id)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($divida) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::emetirBoletoPessoaJuridica($divida, 5);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da divida é obrigatório"], 403);
    }
    
    
    /**
     * Gerar pagamento por Cartao
     *
     * Gerar um boleto | Exemplo: api/v1/pagament/cartao/$pgm_id
     */
    public function gerarPagamentCartao($pgm_id)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();

        
        if ($divida) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::emetirCartao($divida);
            }
            
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::pagarCartao($divida);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da divida é obrigatório"], 403);
    }
    
    
    /**
     * Definir Endereco por boleto pessoa juridica
     *
     * Definir um Endereco para o boleto | Exemplo: api/v1/pagament/boleto/definirEndereco/$pgm_id/$idTransacao
     */
    public function definirEnderecoBoleto($pgm_id, $idTransacao)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($divida) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::definirEnderecoDoBoleto($idTrasacao, $divida);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da divida é obrigatório"], 403);
    }

}

<?php
namespace App\Http\Controllers;

use App\Dividas;
use App\Parametros;
use App\Iugu;
use App\Gerencianet;

/**
 * @resource Pagamento
 */
class PagamentoController extends Controller
{

    /**
     * Gerar pagamento por Boleto
     *
     * Gerar um boleto | Exemplo: api/v1/pagamento/boleto/$pgm_id
     */
    public function gerarPagamentoBoleto($pgm_id)
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
     * Gerar pagamento por boleto pessoa juridica
     *
     * Gerar um boleto | Exemplo: api/v1/pagamento/boleto/pessoaJuridica/$pgm_id
     */
    public function gerarPagamentoBoletoPessoaJuridica($pgm_id)
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
     * Gerar um boleto | Exemplo: api/v1/pagamento/cartao/$pgm_id
     */
    public function gerarPagamementoCartao($pgm_id)
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
     * Definir um Endereco para o boleto | Exemplo: api/v1/pagamento/boleto/definirEndereco/$pgm_id/$idTransacao
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

<?php
namespace App\Http\Controllers;

use App\Parametros;
use Gerencianet\Request;
use App\Gerencianet;

/**
 * @resource Pagamento
 */
class TransacaoController extends Controller
{

    /**
     * Criar Transacao GerenciaNet
     *
     * Buscar Transacao | Exemplo: api/v1/transacao/criar
     */
    public function criar(Request $resquest)
    {
        
        $nome = $resquest->nome;
        $quantidade = $resquest->quantidade;
        $valor = $resquest->valor;
        
        if ($nome && $quantidade && $valor) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::criarTransacao($nome, $quantidade, $valor);
            }
            
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da transacao é obrigatório"], 403);
    }
    
    
    /**
     * Atualizar Transacao GerenciaNet
     *
     * Atualizar Transacao | Exemplo: api/v1/transacao/atualizar
     */
    public function atualizar(Request $resquest)
    {
        
        $idTransacao = $resquest->idTransacao;
        $url = $resquest->url;
        
        if ($idTransacao && $url) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::atualizarTransacao($idTransacao, $url);
            }
            
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da transacao é obrigatório"], 403);
    }
    
    
    /**
     * Detalhar Transacao GerenciaNet
     *
     * Detalhar Transacao | Exemplo: api/v1/transacao/detalhar/$idTransacao
     */
    public function detalhar($idTransacao)
    {
        
        if ($idTransacao) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::detalharTransacoes($idTransacao);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da transacao é obrigatório"], 403);
    }
    
    
    /**
     * Cancelar Transacao GerenciaNet
     *
     * Cancelar Transacao | Exemplo: api/v1/transacao/cancelar/$idTransacao
     */
    public function cancelar($idTransacao)
    {
        
        if ($idTransacao) {
            if (Parametros::getIsGerenciaNet()) {
                $result = Gerencianet::cancelarTransacao($idTransacao);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da transacao é obrigatório"], 403);
    }
    
    
    /**
     * Consultar Notificacao Transacao GerenciaNet
     *
     * Consultar Transacao | Exemplo: api/v1/transacao/cancelar/$idTransacao
     */
    public function consultar()
    {
        
        $result = Gerencianet::consultarNotificacao();
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Estamos com problemas para realizar uma consulta."], 403);
    }
}


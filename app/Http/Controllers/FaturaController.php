<?php
namespace App\Http\Controllers;

use App\Dividas;
use App\Parametros;
use App\Iugu;

/**
 * @resource Pagamento
 */
class FaturaController extends Controller
{

    /**
     * Gerar fautra pelo IUGU
     *
     * Gerar uma fautra | Exemplo: api/v1/fatura/criar
     */
    public function criarFatura($pgm_id)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        if ($divida) {
            if (Parametros::getIsIugu()) {
                
                $emails = $divida->pgm_pagador_email.',smart@smartclic.com.br';
                
                $dataVencimento = date('Y-m-d') + 3;
                
                $items = Iugu::getItems($divida->pgm_pagador_nome, 1, $divida->pgm_valor);
                
                $returnUrl = 'http://smartclic.com.br/';
                
                $expiredUrl = 'http://smartclic.com.br/';
                
                $logs = Iugu::getLogs();
                
                $custonVariables = Iugu::getCustonVariables($divida->pgm_pagador_nome, $divida->pgm_valor);
                
                $result = Iugu::criarFatura($divida->pgm_pagador_email, $emails, $dataVencimento, $items, $returnUrl, $expiredUrl, false, '', true, '', $idCliente, false, null, 'all', null, false, $logs, null, $custonVariables);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Divida é obrigatório"], 403);
    }
    
    
    /**
     * Capturar Fatura 
     *
     * Capturar Fatura | Exemplo: api/v1/fatura/capturar/$idFatura
     */
    public function capturarFatura($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::capturarFatura($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    
    
    /**
     * Reembolsar Fatura
     *
     * Reembolsar Fatura | Exemplo: api/v1/fatura/reembolsar/$idFatura
     */
    public function reembolsarFatura($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::reembolsarFatura($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    
    
    /**
     * Cancelar Fatura
     *
     * Cancelar Fatura | Exemplo: api/v1/fatura/cancelar/$idFatura
     */
    public function cancelarFatura($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::cancelarFatura($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    
    
    
    /**
     * Gerar Segunda Via Fatura
     *
     * Gerar Segunda Via  Fatura | Exemplo: api/v1/fatura/gerarSegundaVia/$idFatura
     */
    public function gerarSegundaViaFatura($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::gerarSegundaViaFatura($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    

    /**
     * Buscar Fatura
     *
     * Buscar Fatura | Exemplo: api/v1/fatura/buscar/$idFatura
     */
    public function buscarFatura($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::buscarFatura($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    
    /**
     * Buscar Fatura
     *
     * Buscar Fatura | Exemplo: api/v1/fatura/listar/
     */
    public function listarFaturas()
    {
        
        if($idFatura){
            $result = Iugu::listarFaturas();
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
    
    
    /**
     * Enviar Email Fatura
     *
     * Enviar Email Fatura | Exemplo: api/v1/fatura/enviarEmail/
     */
    public function enviarEmail($idFatura)
    {
        
        if($idFatura){
            $result = Iugu::listarFaturas($idFatura);
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da Fatura é obrigatório"], 403);
    }
}

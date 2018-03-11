<?php
namespace App\Http\Controllers;

use App\Parametros;
use App\Iugu;
use Gerencianet\Request;

/**
 * @resource Pagamento
 */
class ContestarController extends Controller
{

    /**
     * Disputar contesta��o IUGU
     *
     * Disputar contesta��o | Exemplo: api/v1/contestar/disputar/
     */
    public function disputar(Request $request)
    {
        
        $idContestacao = $request->__get('idContestacao');
        $files = $request->__get('files');
     
        if ($idContestacao && $files) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::disputarContestacao($idContestacao, $files);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da contesta��o � obrigat�rio"], 403);
    }
    
    
    /**
     * Disputar contesta��o IUGU
     *
     * Disputar contesta��o | Exemplo: api/v1/contestar/acatar/$idContestacao
     */
    public function acatar($idContestacao)
    {
        
        if ($idContestacao) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::acatarContestacao($idContestacao);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da contesta��o � obrigat�rio"], 403);
    }
    
    /**
     * Buscar contesta��o IUGU
     *
     * Buscar contesta��o | Exemplo: api/v1/contestar/buscar/$idContestacao
     */
    public function buscar($idContestacao)
    {
        
        if ($idContestacao) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::buscarContestacao($idContestacao);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da contesta��o � obrigat�rio"], 403);
    }
    
    /**
     * Listar contesta��o IUGU
     *
     * Listar contesta��o | Exemplo: api/v1/contestar/listar/$idContestacao
     */
    public function listar($idContestacao)
    {
        
        if ($idContestacao) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::listarContestacao($idContestacao);
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da contesta��o � obrigat�rio"], 403);
    }
    
    
    

}

<?php
namespace App\Http\Controllers;

use App\Dividas;
use App\Parametros;
use App\Iugu;

/**
 * @resource Pagamento
 */
class TransferenciaController extends Controller
{

    /**
     * Gerar transferencia IUGU
     *
     * Gerar um transferencia | Exemplo: api/v1/transferencia/tranferir/$idConta/$valor
     */
    public function transferir($idConta, $idConta)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        
        if ($idConta && $valor) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::transferirValor($idConta, $valor);
            }
        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da divida é obrigatório"], 403);
    }
    
    
    /**
     * Buscar transferencia IUGU
     *
     * Buscar transferencia | Exemplo: api/v1/transferencia/buscar/$idTranferencia
     */
    public function buscar($idTranferencia)
    {
        
        if ($idTranferencia) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::buscarTransferencia($idTranferencia);
            }

        }
        
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Id da tranferencia é obrigatório"], 403);
    }
    
    
    /**
     * Listar Transferências IUGU
     *
     * Listar Transferências | Exemplo: api/v1/transferencia/listar/
     */
    public function listar()
    {
        
        if ($idTranferencia) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::listarTransferencia();
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Tivemos um problema ao listar as transferencias"], 403);
    }
    
    /**
     * Buscar Transferência Bancaria IUGU
     *
     * Buscar Transferência Bancaria | Exemplo: api/v1/transferencia/buscarTransferenciaBancaria/
     */
    public function buscarTransferenciaBancaria()
    {
        
        if ($idTranferencia) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::buscarTransferenciaBancaria();
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Tivemos um problema ao listar as transferencias bancarias"], 403);
    }
    
    /**
     * Listar Transferências Bancarias IUGU
     *
     * Listar Transferências Bancarias | Exemplo: api/v1/transferencia/listarTransferenciaBancarias/
     */
    public function listarTransferenciasBancarias()
    {
        
        if ($idTranferencia) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::listarTransferenciasBancarias();
            }
        }
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Tivemos um problema ao listar as transferencias bancarias"], 403);
    }
}

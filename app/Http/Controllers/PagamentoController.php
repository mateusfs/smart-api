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
     * Gerar Boleto
     *
     * Gerar um boleto | Exemplo: smart/api/v1/pagamento/boleto/$pgm_id
     */
    public function gerarBoleto($pgm_id)
    {
        
        $divida = Dividas::where('pgm_id', $pgm_id)->firstOrFail();
        
        /*
         *  IMPLEMENTAR LOGICA DE COBRANCA DE BOLETO
         *
         */
        
        if ($divida) {
            if (Parametros::getIsIugu()) {
                Iugu::cobrancaDireta($divida);
            }
            
            if (Parametros::getIsGerenciaNet()) {
                Gerencianet::emetirBoleto($divida);
            }
        }
    }
}

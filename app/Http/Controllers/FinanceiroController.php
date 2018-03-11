<?php
namespace App\Http\Controllers;

use App\Iugu;

/**
 * @resource Pagamento
 */
class FinanceiroController extends Controller
{

    /**
     * Extrato Financeiro IUGU
     *
     * Extrato Financeiro | Exemplo: api/v1/financeiro/extratoFinanceiro
     */
    public function extratoFinanceiro()
    {
        
        $result = Iugu::extratoFinanceiro();
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Tivemos algum problema ao realizar o extrato financeiro."], 403);
    }
    
    /**
     * Extrato Faturas IUGU
     *
     * Extrato Faturas | Exemplo: api/v1/financeiro/extratoFaturas
     */
    public function extratoFaturas()
    {
       
        $result = Iugu::extratoFaturas();
        
        if($result){
            return $result;
        }
        
        return response()->json(["error" => "Tivemos algum problema ao realizar o extrato de faturas."], 403);
    }

}

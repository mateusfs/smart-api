<?php
namespace App\Http\Controllers;

use App\Iugu;

/**
 * @resource Financial
 */
class FinancialController extends Controller
{

    /**
     * Financial Statement IUGU
     *
     * Financial Statement | Exemplo: api/v1/financial/financialStatement
     */
    public function financialStatement()
    {
        
        $result = Iugu::financialStatement();
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "We had a problem making the financial statement."], 403);
    }
    
    /**
     * Invoice Statement IUGU
     *
     * Invoice Statement | Exemplo: api/v1/financial/invoiceStatement
     */
    public function invoiceStatement()
    {
       
        $result = Iugu::invoiceStatement();
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "We had a problem making the financial statement."], 403);
    }

}

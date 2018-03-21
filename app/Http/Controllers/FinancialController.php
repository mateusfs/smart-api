<?php
namespace App\Http\Controllers;

use App\Iugu;
use Illuminate\Http\Response;

/**
 * @resource Financial
 */
class FinancialController extends Controller
{

    /**
     * Financial Statement IUGU
     *
     * Financial Statement | Exemplo: api/v1/financial/financialStatement
     * 
	 * @return Response
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
     * 
     * @return Response
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

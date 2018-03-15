<?php
namespace App\Http\Controllers;

use App\Debets;
use App\Parametros;
use App\Iugu;

/**
 * @resource Transfer
 */
class TransferController extends Controller
{

    /**
     * Generate Transfer IUGU
     *
     * Generate a transfer | Example: api/v1/transfer/transfer/$idAccount/$value
     */
    public function transfer($idAccount, $value)
    {
        
        $divida = Debets::where('pgm_id', $pgm_id)->firstOrFail();
        
        
        if ($idAccount && $value) 
        {
            if (Parametros::getIsIugu()) 
            {
                $result = Iugu::transfer($idAccount, $value);
            }
        }
        
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "Transfer ID is required"], 403);
    }
    
    
    /**
     * Search transfer IUGU
     *
     * Search transfer | Example: api/v1/transfer/search/$idTransfer
     */
    public function search($idTransfer)
    {
        
        if ($idTransfer) {
            if (Parametros::getIsIugu()) {
                $result = Iugu::searchTransfer($idTransfer);
            }

        }
        
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "Transfer ID is required"], 403);
    }
    
    
    /**
     * List transfer IUGU
     *
     * List a transfer | Example: api/v1/transfer/list/
     */
    public function listar()
    {
        
        $result = Iugu::listTransfer();
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "We had a problem listing bank transfers"], 403);
    }
    
    /**
     * Search Bank Transfer IUGU
     *
     * Search a bank transfer | Example: api/v1/transfer/searchBankTransfer/
     */
    public function searchBankTransfer()
    {
        
        if (Parametros::getIsIugu()) 
        {
            $result = Iugu::searchBankTransfer();
        }
        
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "We had a problem listing bank transfers"], 403);
    }
    
    /**
     * List Bank Transfer IUGU
     *
     * List bank transfer | Example: api/v1/transfer/listBankTransfers/
     */
    public function listBankTransfers()
    {
        
        if (Parametros::getIsIugu()) 
        {
            $result = Iugu::listBankTransfers();
        }
        
        if($result)
        {
            return $result;
        }
        
        return response()->json(["error" => "We had a problem listing bank transfers"], 403);
    }
}

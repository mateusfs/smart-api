<?php
namespace App\Http\Controllers;

use App\Debt;
use App\Parameter;
use App\Iugu;
use GuzzleHttp\Psr7\Response;

/**
 * @resource Transfer
 */
class TransferController extends Controller
{

    /**
     * Generate Transfer IUGU
     *
     * Generate a transfer | Example: api/v1/transfer/transfer/$idAccount/$value
     * 
     * @param number $idAccount        	
     * @param number $value
     * @return Response
     */
    public function transfer($idAccount, $value)
    {
        
        $divida = Debt::where('pgm_id', $pgm_id)->firstOrFail();
        
        
        if ($idAccount && $value) 
        {
            if (Parameter::getIsIugu()) 
            {
                $result = Iugu::transferValue($idAccount, $value);
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
     * 
     * @param number $idTransfer
     * @return Response
     */
    public function search($idTransfer)
    {
        
        if ($idTransfer) 
        {
            if (Parameter::getIsIugu()) 
            {
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
     * 
     * @return Response
     */
    public function list()
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
     * 
     * @return Response
     */
    public function searchBankTransfer()
    {
        
        if (Parameter::getIsIugu()) 
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
     * 
     * @return Response
     */
    public function listBankTransfers()
    {
        
        if (Parameter::getIsIugu()) 
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

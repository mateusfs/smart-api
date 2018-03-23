<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{

    const CLIENTE_ID_IUGU = "";
    
    const TOKEN_IUGU = "";

    const IS_IUGU = true;

    const CLIENTE_ID_GERENCIA_NET = "";

    const CLIENTE_SECRET_GERENCIA_NET = "";
    
    const PAYMENT_TOKEN_GERENCIA_NET = "";

    const IS_GERENCIA_NET = false;

    /**
     * 
     * @return string
     */
    public static function getIsIugu()
    {
        return self::IS_IUGU;
    }
    
    /**
     * 
     * @return string
     */
    public static function getTokenIugu()
    {
        return base64_encode(self::TOKEN_IUGU);
    }

    /**
     * 
     * @return string
     */
    public static function getClienteIdIugu()
    {
        return self::CLIENTE_ID_IUGU;
    }

    /**
     * 
     * @return string
     */
    public static function getIsGerenciaNet()
    {
        return self::IS_GERENCIA_NET;
    }

    /**
     * 
     * @return string
     */
    public static function getClienteIdGerenciaNet()
    {
        return self::CLIENTE_ID_GERENCIA_NET;
    }

    /**
     * 
     * @return string
     */
    public static function getSecretGerenciaNet()
    {
        return self::CLIENTE_SECRET_GERENCIA_NET;
    }
}
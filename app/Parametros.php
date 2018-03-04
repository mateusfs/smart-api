<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametros extends Model
{

    const CLIENTE_ID_IUGU = "";

    const IS_IUGU = true;

    const CLIENTE_ID_GERENCIA_NET = "";

    const CLIENTE_SECRET_GERENCIA_NET = "";

    const IS_GERENCIA_NET = false;

    public static function getIsIugu()
    {
        return self::IS_IUGU;
    }

    public static function getClienteIdIugu()
    {
        return self::CLIENTE_ID_IUGU;
    }

    public static function getIsGerenciaNet()
    {
        return self::IS_GERENCIA_NET;
    }

    public static function getClienteIdGerenciaNet()
    {
        return self::CLIENTE_ID_GERENCIA_NET;
    }

    public static function getSecretGerenciaNet()
    {
        return self::CLIENTE_SECRET_GERENCIA_NET;
    }
}

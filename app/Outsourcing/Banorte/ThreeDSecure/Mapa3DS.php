<?php

namespace App\Outsourcing\Banorte\ThreeDSecure;

class Mapa3DS
{
    const DIRECTORIO = __DIR__ . DIRECTORY_SEPARATOR . 'paises';

    const CODIGOS_PAISES = [
        'CA', // Canadá
        'MX', // México
        'US', // Estados Unidos de América
    ];


    /*********************************************************************************/


    public static function ruta($codigo_pais)
    {
        return self::DIRECTORIO . DIRECTORY_SEPARATOR . "{$codigo_pais}.php";
    }

    public static function existe($codigo_pais)
    {
        return file_exists( self::ruta($codigo_pais) );
    }

    public static function cargar($codigo_pais)
    {
        return include( self::ruta($codigo_pais) );
    }


    /**********************************************************************************/


    public static function obtenerCodigosPaises(string $concatenar = null)
    {
        return ! empty($concatenar) ? implode($concatenar, self::CODIGOS_PAISES) : self::CODIGOS_PAISES;
    }

    public static function obtenerEstados($codigo_pais)
    {
        return self::existe($codigo_pais) ? self::cargar($codigo_pais)['estados'] : [];
    }

    public static function obtenerCodigosEstados($codigo_pais)
    {
        return array_keys(self::obtenerEstados($codigo_pais));        
    }

    public static function obtenerPaisesConEstados()
    {
        foreach(self::CODIGOS_PAISES as $codigo_pais)
            $paises_estados[$codigo_pais] = self::cargar($codigo_pais);

        return $paises_estados;
    }
}

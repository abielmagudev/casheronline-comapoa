<?php

// Aplicación

if(! function_exists('mantenimiento') )
{
    function mantenimiento()
    {
        static $config = null;

        if( is_null($config) )
            $config = (object) config('aplicacion.mantenimiento');

        return $config;
    }
}


// Laravel

if(! function_exists('isRoute') )
{
    function isRoute($name)
    {
        return str_starts_with(request()->route()->getName(), $name);
    }
}


// Miscelanio

if(! function_exists('capitalizar') )
{
    function capitalizar(string $texto)
    {
        return ucwords( strtolower($texto) );
    }
}

if(! function_exists('unaLetraAleatoria') )
{
    function unaLetraAleatoria()
    {
        $letras = array_merge(range('A','Z'), range('a','z'));
        $indice = mt_rand(1, (count($letras) - 1));
        return $letras[ $indice ];
    }
}

if(! function_exists('str') )
{
    function str(string $contenido)
    {
        return Illuminate\Support\Str::of($contenido);
    }
}

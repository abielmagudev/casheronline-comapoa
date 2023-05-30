<?php

namespace App\Http\Controllers\CuentaAsociadaController\DescargarAction;

class Archivo
{
    public $config;

    public $recurso;

    public function __construct($archivo, $directorio)
    {
        $this->config = (object) config('aplicacion.descargar');

        list($nombre, $extension) = explode('.', $archivo);

        $this->recurso = (object) [
            'archivo' => $archivo,
            'directorio' => $directorio,
            'extension' => $extension,
            'nombre' => $nombre,
        ];
    }

    public function __get($name)
    {
        if( method_exists($this, $name) )
            return call_user_func([$this, $name]);
            
        if( property_exists($this->recurso, $name) )
            return $this->recurso->$name;

        return;
    }

    public function ruta()
    {
        return $this->config->ruta . $this->recurso->directorio . $this->recurso->archivo;
    }

    public function url()
    {
        return $this->config->url . $this->recurso->directorio . $this->recurso->archivo;
    }

    public function existe()
    {
        return is_file( $this->ruta() );
    }
}

<?php

namespace App\Outsourcing\Banorte\Clabe;

use App\Models\Factura;
use Exception;

class Controlador
{
    public $config;

    public $factura;

    public function __construct(Factura $factura, string $respuesta_url)
    {
        $this->config = (object) config('banorte.clabe');
        $this->config->respuesta_url = $respuesta_url;
        $this->factura = $factura;
    }

    public function __get($name)
    {
        try {
            return $this->config->$name;

        } catch(Exception $e) {
            return false;

        }
    }

    public function generarCamposPeticion()
    {
        return [
			'amount' => $this->factura->importe_transaccion,

            /**
             * 3D Secure v2 
             * Restringe que el valor de "nombre" tenga como máximo de 40 caractéres
             */
			'clientName' => substr($this->factura->nombre_cuenta, 0, 40),

			'description' => $this->config->descripcion,
			'emitter' => $this->config->emisor,
			'reference' => $this->factura->numero_cuenta,
			'responseUrl' => $this->config->respuesta_url,
			'serviceName' => $this->config->nombre,
        ];
    }
}

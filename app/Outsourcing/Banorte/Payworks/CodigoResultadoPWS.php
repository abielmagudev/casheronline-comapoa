<?php

namespace App\Outsourcing\Banorte\Payworks;

/**
 * ManualDeIntegracion_ComercioElectrónico_V2.1 (pág. 5, 11)
 * 
 * RESULTADO_PAYW / PAYW_RESULT
 */
class CodigoResultadoPWS
{
    const APROBADO = 'A';

    public static $codigos_mensajes_descripciones = [
        'A' => ['Aprobada', 'Transacción ha sido aprobada'],
		'D' => ['Declinada', 'Transacción ha sido declinada'],
		'R' => ['Rechazada', 'Transacción ha sido rechazada'],
		'T' => ['Sin respuesta del autorizador', 'Transacción ha fallado'],
    ];

    public $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    public function existe()
    {
        return array_key_exists($this->codigo, self::$codigos_mensajes_descripciones);
    }

    public function mensaje()
    {
        return $this->existe() ? self::$codigos_mensajes_descripciones[$this->codigo][0] : null;
    }

    public function descripcion()
    {
        return $this->existe() ? self::$codigos_mensajes_descripciones[$this->codigo][1] : null;
    }

    public function estaAprobado()
    {
        return self::APROBADO == $this->codigo;
    }
}

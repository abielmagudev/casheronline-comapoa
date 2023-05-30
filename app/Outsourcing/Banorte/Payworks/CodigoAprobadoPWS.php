<?php

namespace App\Outsourcing\Banorte\Payworks;

class CodigoAprobadoPWS
{
    public $codigo;

    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }
}

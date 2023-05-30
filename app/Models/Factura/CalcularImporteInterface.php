<?php

namespace App\Models\Factura;

use App\Models\Factura;

interface CalcularImporteInterface
{
    public static function calcularImporte(Factura $factura);
}

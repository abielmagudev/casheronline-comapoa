<?php

namespace App\Models\Factura;

use App\Models\Factura;

interface CalcularSaldoInterface
{
    public static function calcularSaldo(Factura $factura);
}

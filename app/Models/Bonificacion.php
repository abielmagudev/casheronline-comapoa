<?php

namespace App\Models;

use App\Models\Factura\CalcularSaldoInterface;
use Illuminate\Database\Eloquent\Model;

class Bonificacion extends Model implements CalcularSaldoInterface
{
    protected $table = 'bonifica';


    // Attributes

    public function getPagoAttribute()
    {
        return $this->PAGO_ACT;
    }


    // Scopes

    public function scopePorRutaFolio($query, string $clave_ruta, string $numero_folio)
    {
        return $query->where('RUTA', $clave_ruta)->where('FOLIO', $numero_folio);
    }


    // Interfaces

    public static function calcularSaldo(Factura $factura)
    {
        if(! $bonificacion = self::porRutaFolio($factura->clave_ruta, $factura->numero_folio)->get() )
            return;

        return $bonificacion->sum('pago');
    }
}

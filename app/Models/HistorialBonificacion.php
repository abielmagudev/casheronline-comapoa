<?php

namespace App\Models;

use App\Models\Factura\CalcularSaldoInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Este concepto es una ayuda para el usuario, cuando este no le es posible pagar el importe.
 * 
 * Ejemplo:
 * Usuario importe = 2000
 * COMAPA bonifica = 1000
 * Nuevo importe = AdeudoTotal:2000 - Bonificacion:1000 = 1000
 * 
 */
class HistorialBonificacion extends Model implements CalcularSaldoInterface
{
    protected $table = 'hist_bon';

    
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
        if(! $historial_bonificaciones = self::porRutaFolio($factura->clave_ruta, $factura->numero_folio)->get() )
            return;

        return $historial_bonificaciones->sum('pago');
    }
}

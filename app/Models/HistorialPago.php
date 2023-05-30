<?php

namespace App\Models;

use App\Models\Factura\CalcularSaldoInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Cuando son procesados desaparecen de PagoDiario y se pasa aqui...
 */
class HistorialPago extends Model implements CalcularSaldoInterface
{
    protected $table = 'hist_pag';


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
        if(! $historial_pago = self::porRutaFolio($factura->clave_ruta, $factura->numero_folio)->get() )
            return;

        return $historial_pago->sum('pago');
    }
}

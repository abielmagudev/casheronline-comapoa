<?php

namespace App\Models;

use App\Models\Factura\CalcularImporteInterface;
use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

class Medidor extends Model implements CalcularImporteInterface
{
    use AyudasTabla;

    protected $table = 'medis';


    // Scopes

    public function scopePorRutaFolio($query, string $ruta, string $folio)
    {
        return $query->where('RUTA', $ruta)->where('FOLIO', $folio);
    }


    // Interfaces

    public static function calcularImporte(Factura $factura)
    {
        if(! $medidor = self::porRutaFolio($factura->clave_ruta, $factura->FOLIO)->first() )
            return;

        return $medidor->PAGO;
    }
}

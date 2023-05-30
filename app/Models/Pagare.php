<?php

namespace App\Models;

use App\Models\Factura\CalcularImporteInterface;
use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

class Pagare extends Model implements CalcularImporteInterface
{
    use AyudasTabla;

    protected $table = 'pag_doc';


    // Attributes

    public function getNumeroAttribute()
    {
        return $this->PAGARE;
    }

    public function getPagoAttribute()
    {
        return $this->PAGO_ACT;
    }


    // Relationships

    public function factura()
    {
        return $this->hasOne(Factura::class, 'PAGARE', 'PAGARE');
    }


    // Scopes

    public function scopeWhereNumero($query, $numero)
    {
        return $query->where('PAGARE', $numero);
    }


    // Interfaces

    /**
    * Si el recibo con numero_pagare es 0 respondera true comparando pagare 000000,	
    * para evitar este falso positivo, se valida contra 1 para asegurar el registro correcto
    * 
    */
    public static function calcularImporte(Factura $factura)
    {
        if( $factura->numero_pagare < 1 )
            return;

        if(! $pagare = self::whereNumero($factura->numero_pagare)->first() )
            return;

        return $pagare->pago;
    }
}

<?php

namespace App\Models\Transaccion;

trait PayworksTrait
{
    public function getReferenciaPayworksAttribute()
    {
        return $this->referenciapay;
    }

    public function getFechaHoraPayworksAttribute()
    {
        return $this->fecha . ' ' . $this->hora;
    }

    public function getCodigoAutorizacionPayworksAttribute()
    {
        return $this->codigoautpay;
    }
}

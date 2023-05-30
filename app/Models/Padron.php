<?php

namespace App\Models;

use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

class Padron extends Model
{
    use AyudasTabla;
    
    protected $table = 'padron';

    // protected $primaryKey = 'CUENTA'; // ID


    // Attributes

    public function getNumeroCuentaAttribute()
    {
        return $this->CUENTA;
    }

    public function getNombreCompletoAttribute()
    {
        return $this->NOMBRE;
    }

    public function getNumeroNombreCuentaAttribute()
    {
        return sprintf('%s - %s', $this->numero_cuenta, $this->nombre_completo);
    }


    // Relationships

    public function factura()
    {
        return $this->hasOne(Factura::class, 'CUENTA', 'CUENTA');
    }

    public function ruta()
    {
        return $this->hasOne(Ruta::class, 'CVE_RUTA', 'RUTA');
    }

    public function cuenta_asociada()
    {
        return $this->hasOne(CuentaAsociada::class, 'cuenta', 'CUENTA');
    }

    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'cuenta', 'cuenta');
    }


    // Relationships attribute

    public function getMedidorAttribute()
    {
        return Medidor::porRutaFolio($this->RUTA, $this->FOLIO);
    }   


    // Scopes

    public function scopeWhereInCuenta($query, array $numeros)
    {
        return $this->whereIn('CUENTA', $numeros);
    }
}

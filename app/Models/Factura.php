<?php

namespace App\Models;

use App\Models\Factura\EstatusTrait;
use App\Models\Factura\ImporteSaldoTrait;
use App\Models\Factura\Vencimiento;
use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use AyudasTabla;
    use EstatusTrait;
    use ImporteSaldoTrait;

    protected $table = 'fact_ant';

    protected $vencimiento_cache;

    // protected $primaryKey = 'CUENTA'; // ID

    
    // Attributes renamed

    public function getNumeroCuentaAttribute()
    {
        return $this->CUENTA;
    }

    public function getNombreCuentaAttribute()
    {
        return $this->padron->nombre_completo;
    }

    public function getNumeroConvenioAttribute()
    {
        return $this->REZAGO_MAN;
    }

    public function getNumeroFolioAttribute()
    {
        return $this->FOLIO;
    }

    public function getAdeudoAttribute()
    {
        return $this->AD_TOTAL;
    }

    /**
     * Utiliza la función getAttribute para obtener el valor directo de la propiedad,
     * y así, evitar conflicto de retornar la relacion del modelo RUTA.
     * 
     * $this->RUTA = Ruta::class
     */
    public function getClaveRutaAttribute()
    {
        return $this->getAttribute('RUTA');
    }

    public function getNumeroPagareAttribute()
    {
        return $this->getAttribute('PAGARE');
    }



    // Attributes

    public function getCodigoPeriodoAttribute()
    {
        return $this->PERIODO;
    }

    public function getVencimientoAttribute()
    {
        if( is_null($this->vencimiento_cache) )
            $this->vencimiento_cache = new Vencimiento($this->ruta->clave_dia_vencimiento, $this->codigo_periodo);

        return $this->vencimiento_cache;
    }


    // Relationships

    public function padron()
    {
        return $this->hasOne(Padron::class, 'CUENTA', 'CUENTA');
    }

    public function ruta()
    {
        return $this->hasOne(Ruta::class, 'CVE_RUTA', 'RUTA');
    }

    public function convenio()
    {
        return $this->hasMany(Convenio::class, 'convenio', 'REZAGO_MAN');
    }

    public function pagare()
    {
        return $this->hasMany(Pagare::class, 'PAGARE', 'PAGARE');
    }


    // Relationships attribute

    public function getMedidorAttribute()
    {
        return Medidor::porRutaFolio($this->RUTA, $this->FOLIO);
    }   


    // Scopes

    public function scopeWhereInCuenta($query, array $numeros)
    {
        return $query->whereIn('CUENTA', $numeros);
    }

    public function scopeWhereCuenta($query, string $numero)
    {
        return $query->where('CUENTA', $numero);
    }
}

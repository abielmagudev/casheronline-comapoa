<?php

namespace App\Models;

use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

/**
 * RUTA = Sector(calle, colonia) en la ciudad
 * FOLIO = ID de ubicacion del domicilio (Anteriormente, ahora se utiliza CUENTA para ID del usuario independiente de su ubicacion)
 */

class Ruta extends Model
{
    use AyudasTabla;

    protected $table = 'rutas';


    // Attributes

    public function getClaveRutaAttribute()
    {
        return $this->CVE_RUTA;
    }

    public function getClaveDiaVencimientoAttribute()
    {
        return $this->CVE_VENC;
    }
}

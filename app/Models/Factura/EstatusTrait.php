<?php

namespace App\Models\Factura;

trait EstatusTrait
{
    public $colores_estatus = [
        'atrasado' => 'danger',
        'en proceso' => 'warning',
        'pagado' => 'secondary',
        'vigente' => 'success',
    ];

    
    // Attributes

    public function getEstatusAttribute()
    {
        if(! $this->requierePago() )
            return 'pagado';

        return $this->vencimiento->estaTiempoPagar() ? 'vigente' : 'atrasado';
    }

    public function getColorEstatusAttribute()
    {
        return $this->colores_estatus[ $this->estatus ];
    } 
}




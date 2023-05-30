<?php 

namespace App\Outsourcing\Mensajero\Funciones;

trait AdjuntoTrait
{
    public function adjuntarUno(string $archivo, string $renombre = null)
    {
        $this->phpmailer->addAttachment($archivo, $renombre);
    }

    public function adjuntarMuchos(array $archivos_renombres)
    {
        foreach($archivos_renombres as $archivo => $renombre)
            $this->adjuntarUno($archivo, $renombre);
    }

    public function adjuntar(...$argumentos)
    {
        $filtrados = array_filter($argumentos);

        if( empty($filtrados) )
            return;

        if( is_array($filtrados[0]) )
            $this->adjuntarMuchos($filtrados[0]);

        if( is_string($filtrados[0]) )
            $this->adjuntarUno($filtrados[0], $filtrados[1] ?? null);
    }
}

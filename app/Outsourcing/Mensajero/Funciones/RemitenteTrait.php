<?php 

namespace App\Outsourcing\Mensajero\Funciones;

trait RemitenteTrait
{
    public function remitente(string $direccion, string $nombre = null)
    {
        $this->phpmailer->setFrom($direccion, $nombre);
    }
}

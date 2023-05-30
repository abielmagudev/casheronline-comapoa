<?php 

namespace App\Outsourcing\Mensajero\Funciones;

trait ContenidoTrait
{
    public function asunto(string $asunto)
    {
        $this->phpmailer->Subject = $asunto;
    }

    public function cuerpo(string $cuerpo)
    {
        $this->phpmailer->Body = $cuerpo;
    }

    public function cuerpoAlternativo(string $cuerpo_alternativo)
    {
        $this->phpmailer->AltBody = $cuerpo_alternativo;
    }
}

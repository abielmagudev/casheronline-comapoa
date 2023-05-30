<?php 

namespace App\Outsourcing\Mensajero\Funciones;

trait DestinatarioTrait
{
    public function destinatario(string $direccion, string $nombre = null)
    {
        $this->phpmailer->addAddress($direccion, $nombre);
    }

    public function destinatarios(array $direcciones_nombres)
    {
        foreach($direcciones_nombres as $direccion => $nombre)
            $this->destinatario($direccion, $nombre);
    }

    public function copia(string $direccion, string $nombre = null)
    {
        $this->phpmailer->addCC($direccion, $nombre);
    }

    public function copias(array $direcciones_nombres)
    {
        foreach($direcciones_nombres as $direccion => $nombre)
            $this->copia($direccion, $nombre);
    }

    public function copiaOculta(string $direccion, string $nombre = null)
    {
        $this->phpmailer->addBCC($direccion, $nombre);
    }

    public function copiasOcultas(array $direcciones_nombres)
    {
        foreach($direcciones_nombres as $direccion => $nombre)
            $this->copiaOculta($direccion, $nombre);
    }
}

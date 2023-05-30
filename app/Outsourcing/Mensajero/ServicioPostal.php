<?php

namespace App\Outsourcing\Mensajero;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class ServicioPostal
{
    public $config;

    public $phpmailer;

    public function __construct()
    {
        try {
            $this->config = (object) config('aplicacion.phpmailer');

        } catch (Exception $e) {
            return $e->getMessage();
            
        }

        $this->iniciarPHPMailer();
    }

    public function iniciarPHPMailer()
    {
        $this->phpmailer = new PHPMailer( $this->config->has_exceptions );
        $this->phpmailer->Host = $this->config->host;
        $this->phpmailer->Port = $this->config->port;
        $this->phpmailer->SMTPAuth = $this->config->is_auth;
        $this->phpmailer->SMTPDebug = $this->config->debug;
        $this->phpmailer->SMTPSecure = $this->config->secure;
        $this->phpmailer->SMTPOptions = $this->config->options;
        $this->phpmailer->Username = $this->config->username;
        $this->phpmailer->Password = $this->config->password;
        $this->phpmailer->CharSet = $this->config->charset;
        $this->phpmailer->isHTML( $this->config->is_html );
        $this->phpmailer->isSMTP();
        $this->phpmailer->setFrom( $this->config->username, $this->config->name );
    }

    public function autenticar(string $usuario, string $contrasena)
    {
        $this->phpmailer->Username = $usuario;
        $this->phpmailer->Password = $contrasena;
    }

    public function enviar()
    {
        $this->phpmailer->send();
    }
}

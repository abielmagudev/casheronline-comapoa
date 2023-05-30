<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

return [
    'debug' => SMTP::DEBUG_SERVER, // DEBUG_SERVER or DEBUG_OFF -> SMTP.php:110
    'secure' => PHPMailer::ENCRYPTION_STARTTLS, // ENCRYPTION_SMTPS=ssl | ENCRYPTION_STARTTLS=tls
    'charset' => 'UTF-8',
    'port' => 25, // 25, 2525, 587:(TLS), 465:encrypted(SSL) 
    'host' => '',
    'username' => '',
    'password' => '',
    'name' => '',
    'has_exceptions' => true,
    'is_auth' => true,
    'is_html' => true,
    'options' => [
        'ssl' => [
            'allow_self_signed' => true,
            'verify_peer_name' => false,
            'verify_peer' => false,
        ]
    ],
];

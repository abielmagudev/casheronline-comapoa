<?php

/**
 * Portal Clabe Controller Web
 * Pagar con una cuentahabiente en el portal de Banorte.
 * 
 * $respuesta_url se puede asignar directamente en Banorte/Clabe/Portal, 
 * ya que depende de la factura que se pagará.
 */
return [
    'color' => '#eb0029',
    'descripcion' => 'Cobro del recibo COMAPA',
    'emisor' => 99073,
    'nombre' => 'paymentClabe',
    'respuesta_url' => null,
    'peticion_url' => 'https://www.banorte.com/clabes/controller',
];

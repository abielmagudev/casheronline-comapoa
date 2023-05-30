<?php

return [
    'cvv' => '^[0-9]{3,4}$',
    'letras_espacios' => '^[a-zA-Z\s]*$',
    'letras_numeros_espacios' => '^[a-zA-Z0-9\s]+$',
    'nombre_cuenta' => '^[A-Z\s]+$', 
    'nombre_usuario' => '^[a-zA-Z0-9_]+$',
    'numero_cuenta' => '^\d{6}$',
    'numero_tarjeta_bancaria' => '^\d{16}$',
    'numeros' => '^\d+$',
    'usuario' => '^[\w]{6,12}$',
];

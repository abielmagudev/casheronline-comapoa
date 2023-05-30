<?php

namespace App\Outsourcing\Banorte\Payworks;

use App\Models\TarjetaBancaria;
use App\Models\Transaccion;
use Illuminate\Support\Str;

class PeticionPWS
{
    public $transaccion;

    public $tarjeta_bancaria;

    public $codigo_seguridad_tarjeta_bancaria;

    public $config;

    public function __construct(Transaccion $transaccion, string $codigo_verificacion_tarjeta_bancaria)
    {
        $this->transaccion = $transaccion;

        $this->codigo_seguridad_tarjeta_bancaria = $codigo_verificacion_tarjeta_bancaria;

        $this->config = (object) [
            'comercio' => config('banorte.afiliacion'),
            'threeDsecure' => config('banorte.threedsecure'),
        ];
    }

    /**
     * ManualDeIntegracion_ComercioElectrónico_V2.1 - pág.7
     * Variables de envío
     */
    public function variables()
    {
		return [
            // Transacción
			'CAVV' => $this->transaccion->cavv,
			'ECI' => $this->transaccion->eci,
			'ESTATUS_3D' => $this->transaccion->status,
			'MONTO' => $this->transaccion->monto,
			'NUMERO_CONTROL' => $this->transaccion->numerounico,
			'XID' => $this->transaccion->xid,
			//'REFERENCIA' => null, // Referencia de la transaccion anterior a esta
                        
            // Afiliación de comercio
			'CLAVE_USR' => $this->config->comercio['clave_usr'],
			'CMD_TRANS' => $this->config->comercio['cmd_trans'],
			'ID_AFILIACION' => $this->config->comercio['id'],
			'ID_TERMINAL' => $this->config->comercio['id_terminal'],
			'IDIOMA_RESPUESTA' => $this->config->comercio['idioma_respuesta'], 
			'MODO_ENTRADA' => $this->config->comercio['modo_entrada'],
			'MODO' => $this->config->comercio['modo'],
			'USUARIO' => $this->config->comercio['usuario'],
            
            // Tarjeta bancaria
			'CODIGO_SEGURIDAD' => $this->codigo_seguridad_tarjeta_bancaria,
			'FECHA_EXP' => $this->transaccion->tarjeta_bancaria->expira_sin_separador,
			'NUMERO_TARJETA' => $this->transaccion->tarjeta_bancaria->numero,

            // 3D Secure
			'VERSION_3D' => $this->config->threeDsecure['version'],
			
			/**
			* Esta variable(REF_CLIENTE#) se retorna para uso propio del comercio, 
			* como variable de retorno.
			*/
			'REF_CLIENTE1' => sprintf('C%s', $this->transaccion->numero_cuenta),
			'REF_CLIENTE2' => sprintf('T%s', $this->transaccion->id),
        ];
    }

    public function variablesValidas()
    {
        return array_filter($this->variables(), 'strlen');
    }

    public function obtenerUrl()
    {
        return config('banorte.payworks.url');
    }

    /**
     * ManualDeIntegracion_ComercioElectrónico_V2.1 - pág.7
     * 
     * Genera un número de control de ~30 caracteres~, integrando el valor de REFERENCIA3D
     * generado por la Peticion3DS y verificado por Respuesta3DS con una longitud de 15 caracteres,
     * por lo que se integra otros datos para completar la longitud requerida(30 caracteres)
     * 
     * 14 caracteres) String random: Str::random(14)
     * 15 caracteres) REFERENCIA3D: $referencia3D
     * 1 caracter) Una letra aleatoria: unaLetraAleatoria():asistentes.php
     */
    public static function generarNumeroControl(string $referencia3D)
    {
        return Str::random(14) . $referencia3D . unaLetraAleatoria();
    }
}

/*
ManualDeIntegracion_ComercioElectrónico_V2.1 (pág.6)

VARIABLES PAYWORKS

ID_AFILIACION - MERCHANT_ID
USUARIO - USER
CLAVE_USR - PASSWORD
CMD_TRANS - CMD_TRANS
ID_TERMINAL - TERMINAL_ID
MONTO - AMOUNT
MODO - MODE
REFERENCIA - REFERENCE
NUMERO_CONTROL - CONTROL_NUMBER
REF_CLIENTE1 - CUSTOMER_REF1
REF_CLIENTE2 - CUSTOMER_REF2
REF_CLIENTE3 - CUSTOMER_REF3
REF_CLIENTE4 - CUSTOMER_REF4
REF_CLIENTE5 - CUSTOMER_REF5
NUMERO_TARJETA - CARD_NUMBER
FECHA_EXP - CARD_EXP
CODIGO_SEGURIDAD - SECURITY_CODE
MODO_ENTRADA - ENTRY_MODE
LOTE - GROUP
IDIOMA_RESPUESTA - RESPONSE_LANGUAGE
ESTATUS_3D - STATUS_3D
ECI - ECI
XID - XID
CAVV - CAVV
VERSION_3D - VERSION_3D
ID_TRANSACCION - TRANSACTION_ID


NOTAS SOBRE VARIABLES 3D SECURE:
• Si las Variables XID y CAVV retornaron valor Nulo o Blanco en la respuesta de la autenticación 3D Secure, no enviar en el post hacia Payworks.


Pagina 10
Variables que se utilizan únicamente para transacciones con pagos diferidos Q6

DIFERIMIENTO_INICIAL - INITIAL_DEFERMENT
NUMERO_PAGOS - PAYMENTS_NUMBER
TIPO_PLAN - PLAN_TYPE


// ManualDeIntegración_3DSecure2.0_V1.2 (pág.8)

'envio' => [
	'ciudad' => '', // 50
	'pais' => '', // 2
	'codigo' => '', // 2 Destino
	'nombre' => '', // 60
	'apellido' => '', // 60
	'celular' => '', // 14 digitos
	'codigo_postal' => '', // 10
	'metodo' => '', // 8 sameday, oneday, twoday, threeday, lowcost, pickup, other, none
	'estado' => '', // 2
	'calle_1' => '', // 40
],

*/

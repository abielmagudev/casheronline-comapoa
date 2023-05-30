<?php

namespace App\Outsourcing\Banorte\ThreeDSecure;

use App\Models\Factura;
use App\Models\MovimientoWeb;
use App\Models\TarjetaBancaria;

class Peticion3DS
{
    public $tarjeta_bancaria;
    
    public $factura;
 
    public $config;

    public function __construct(TarjetaBancaria $tarjeta_bancaria, Factura $factura, string $url_respuesta)
    {
        $this->tarjeta_bancaria = $tarjeta_bancaria;
        $this->factura = $factura;
        $this->config = (object) config('banorte.threedsecure');
        $this->config->afiliacion = (object) config('banorte.afiliacion');
        $this->config->url_respuesta = $url_respuesta;
    }

    /**
     * Generador de variables para crear los campos del formulario para 
     * realizar la peticion de verificación de 3D Secure
     * 
     * Tabla1 = GuiaRapidaMigracion3DSecure2.0_ComercioElectrónico_V1.0: pag.4
     * Tabla2 = GuiaRapidaMigracion3DSecure2.0_ComercioElectrónico_V1.0: pag.4
     * REFERENCIA3D = ManualDeIntegración_3DSecure2.0_V1.2: pag.6
     * TIPO_TARJETA = ManualDeIntegración_3DSecure2.0_V1.2: pag.7
     */
    public function variables()
    {
        return [
            // Monto: importe, total
			'MONTO' => $this->factura->importe_transaccion, // tabla1

            // Afiliación
			'ID_AFILIACION' => $this->config->afiliacion->id, // tabla1
			'NOMBRE_COMERCIO' => $this->config->afiliacion->nombre, // tabla1
			'CIUDAD_COMERCIO' => $this->config->afiliacion->ciudad, // tabla1

            // Tarjeta bancaria
			'MARCA_TARJETA' => self::obtenerMarcaTarjetaBancaria( $this->tarjeta_bancaria->nombre_red ), // tabla1
			'NUMERO_TARJETA' => $this->tarjeta_bancaria->numero, // tabla1
			'TIPO_TARJETA' => $this->tarjeta_bancaria->clave_tipo, // tabla2
			'NOMBRE' => $this->tarjeta_bancaria->info('nombre'), // tabla2
			'APELLIDO' => $this->tarjeta_bancaria->info('apellido'), // tabla2
			'CALLE' => $this->tarjeta_bancaria->info('calle'), // tabla2
			'CODIGO_POSTAL' => $this->tarjeta_bancaria->info('codigo_postal'), // tabla2
			'CIUDAD' => $this->tarjeta_bancaria->info('ciudad'), // tabla2
			'ESTADO' => $this->tarjeta_bancaria->info('estado'), // tabla2
			'PAIS' => $this->tarjeta_bancaria->info('pais'), // tabla2
			'CORREO' => $this->tarjeta_bancaria->info('correo'), // tabla2
			'NUMERO_CELULAR' => $this->tarjeta_bancaria->info('numero_celular'), // tabla2
			'FECHA_EXP' => $this->tarjeta_bancaria->expira, // tabla1
            
            // 3D Secure
			'REFERENCIA3D' => $this->generarReferencia3D(),  // tabla1
			'CERTIFICACION_3D' => $this->config->certificacion, // tabla1
			'URL_RESPUESTA' => $this->config->url_respuesta, // tabla1
            'VERSION_3D' => $this->config->version, // tabla2
			
			/**
			* ManualDeIntegración_3DSecure2.0_V1.2: pag.8
            *
            * Todas las variables que terminan con _ENVIO son opcionales 
			* excepto para comercios tipo paqueterias, correo...
			*/
			// 'CIUDAD_ENVIO' => '',
			// 'PAIS_ENVIO' => '',
			// 'CODIGO_ENVIO' => '',
			// 'NOMBRE_ENVIO' => '',
			// 'APELLIDO_ENVIO' => '',
			// 'CELULAR_ENVIO' => '',
			// 'CODIGO_POSTAL_ENVIO' => '',
			// 'METODO_ENVIO' => '', 
			// 'ESTADO_ENVIO' => '',
			// 'CALLE_ENVIO1' => '',
			// 'CALLE_ENVIO2' => '',
			
			/**
			* MODO ANTERIOR, Actualmente NO retorna variables adicionales a las que solicita 3DSecure
			* Informacion extra, posible retorno de variables en respuesta de Secure3D
			*/
			// 'AMBITO' => self::AMBITO,
			// 'CODIGO_SEGURIDAD' => $this->codigo_seguridad, // CVV2
		];
    }

    /**
	* ManualDeIntegración_3DSecure2.0_V1.2: pag.6
    * El valor de "REFERENCIA3D" debe ser exactamente de 15 caracteres
    * 
    * En caso de cumplir con los 15 caracteres, al final rellenará hacia
    * la izquierda con el número "0" hasta cubrir la longitud requerida
	*/
    public function generarReferencia3D()
    {
        $referencia3D = implode([
            // Ambito del MovimientoWeb (1 caracter)
            MovimientoWeb::CODIGO_AMBITO,

            // Número de cuenta de la Factura (6 caracteres)
            $this->factura->numero_cuenta,

            // Ultimos cuatro digitos del número de tarjeta bancaria  (4 caracteres)
            $this->tarjeta_bancaria->ultimos_cuatro_digitos,

            // Genera un número aleatorio para sea único 0001, 9999 (4 caracteres)
            str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT)
        ]);

        return str_pad($referencia3D, 15, '0', STR_PAD_LEFT);
    }

    /**
     * Obtener valor de la configuración de la URL para la petición de 3DSecure
     */
    public function obtenerUrl()
    {
        return $this->config->url;
    }


    // Statics

    /**
     * Si el nombre de la red de la tarjeta bancaria es MasterCard, es necesario utilizar la
     * convencion 'MC' para esta red según los requerimientos de 3D Secure
     */
    public static function obtenerMarcaTarjetaBancaria(string $nombre_red)
    {
        return strtolower($nombre_red) <> 'mastercard' ? strtoupper($nombre_red) : 'MC';
    }
}

/*

La nueva versión de autenticación de 3D Secure 2.0 se desarrolla con apoyo del manual de
Integración que se anexa en este comunicado ManualDeIntegración_eCommerce_V2.1.pdf
El método de envió de la mensajería no cambiará, seguirá enviándose través del método http post
como actualmente tiene su integración con la versión 1.0 de 3D Secure Banorte.

Importante: Para la conexión debe utilizar una de sus afiliaciones productivas de comercio
electrónico con 3D Secure.

	
TABLA DE VARIABLES DE ENVIO A SECURE3D v1

NUMERO_TARJETA   - CARD_NUMBER
FECHA_EXP        - CARD_EXP
MONTO            - AMOUNT
MARCA_TARJETA    - CARD_TYPE
ID_AFILIACION    - MERCHANT_ID
NOMBRE_COMERCIO  - MERCHANT_NAME
CIUDAD_COMERCIO  - MERCHANT_CITY
URL_RESPUESTA    - FORWARD_PATH
CERTIFICACION_3D - 3D_CERTIFICATION
REFERENCIA3D     - REFERENCE3D


TABLA DE VARIABLES DE ENVIO A SECURE3D v2

CIUDAD 				- CITY
PAIS 				- COUNTRY
CORREO 				- EMAIL
NOMBRE 				- NAME
APELLIDO 			- LAST_NAME
CODIGO_POSTAL 		- POSTAL_CODE
ESTADO 				- STATE
CALLE 				- STREET
VERSION_3D 			- THREED_VERSION
NUMERO_CELULAR 		- MOBILE_PHONE
TIPO_TARJETA 		- CREDIT_TYPE
CIUDAD_ENVIO 		- SHIPTO_CITY
PAIS_ENVIO 			- SHIPTO_COUNTRY
CODIGO_ENVIO 		- SHIPTO_DESTINATIONCODE
NOMBRE_ENVIO 		- SHIPTO_FIRSTNAME
APELLIDO_ENVIO 		- SHIPTO_LASTNAME
CELULAR_ENVIO 		- SHIPTO_PHONENUMBER
CODIGO_POSTAL_ENVIO - SHIPTO_POSTALCODE
METODO_ENVIO 		- SHIPTO_SHIPPINGMETHOD
ESTADO_ENVIO 		- SHIPTO_STATE
CALLE_ENVIO1 		- SHIPTO_STREET1
CALLE_ENVIO2 		- SHIPTO_STREET2


Adicional a las variables que actualmente manda a Payworks Banorte en el segundo post para el
procesamiento de la transacción, se debe adicionar la nueva variable:

VERSION_3D - VERSION_3D

*/

<?php

namespace App\Outsourcing\Banorte\Payworks;

use Illuminate\Http\Request;

class RespuestaPWS
{
    /**
     * ManualDeIntegracion_ComercioElectrónico_V2.1 (pág.11)
     * Variables de retorno de tipo fecha y hora
     * Formato fecha: AAAAMMDD | hora: HH:MM:SS.sss
     */
    public $campos_tiempo = [
        'FECHA_REQ_CTE',
        'FECHA_RSP_CTE',
        'FECHA_REQ_AUT',
        'FECHA_RSP_AUT',
    ];

    public $campos;

    public $resultado;

    public $autorizador;

    public $rechazado;

    public $aprobado;

    public function __construct($respuesta)
    {
        $this->campos = $this->generarCamposDesdeGuzzleHttpClient($respuesta);

        $this->resultado = new CodigoResultadoPWS( $this->campo('RESULTADO_PAYW') );

        $this->autorizador = new CodigoAutorizadorPWS( $this->campo('RESULTADO_AUT') );

        $this->rechazado = new CodigoRechazadoPWS( $this->campo('CODIGO_PAYW') );

        $this->aprobado = new CodigoAprobadoPWS( $this->campo('CODIGO_AUT') );
    }


    /**
     * Genera campos a partir de una cadena de texto al recibir la respuesta de Payworks directamente con cURL
     * NO se utiliza la libreria GuzzleHttpClient de Laravel
     */
    private function generarCamposDesdeCadenaTexto(string $cadena_campos)
    {
        $campos_cache = array();

        $lineas = explode('\n', $cadena_campos);

        foreach($lineas as $linea)
        {
            if( strpos($linea, ': ') !== false )
            {
                list($llave, $valor) = explode(': ', $linea);
                $campos_cache[$llave] = trim($valor);
            }
        }

        return $campos_cache;
    }


    /**
     * Genera campos a partir de las cabeceras recibidas por respuesta de Payworks gestionadas por GuzzleHttpClient de Laravel
     * Cada cabecera tiene un valor en array, por lo que se debe extraer el valor del array de la cabecera.
     * 
     * https://laravel.com/docs/9.x/http-client
     */
    private function generarCamposDesdeGuzzleHttpClient(array $arreglo_campos)
    {
        $campos_cache = array();

        foreach($arreglo_campos as $campo => $array)
            $campos_cache[$campo] = $array[0];

        return $campos_cache;
    }


    // Atributos

    public function campo(string $nombre, $predeterminado = null)
    {
        return array_key_exists($nombre, $this->campos) ? $this->campos[$nombre] : $predeterminado;
    }

    /**
     * ManualDeIntegracion_ComercioElectrónico_V2.1 (pág.11)
     * 
     * 1) Valida que el nombre del campo pertenezca a un campo de tiempo para gestionarlo.
     * en caso contrario, retorna falso porque no puede gestionarse como fecha
     * 
     * 2) Valida que el valor obtenido sea un string y sea dividido por el espacio, separando la fecha[0] y hora[1] de Payworks
     * en caso contrario, retorna un array vacio porque quizas el campo no esta presente o es un valor NULL
     * 
     * 3) Retorna un array con los valores de fecha y hora, para dar formato personalizado a la respuesta de Payworks,
     *    se convierte a segundos(strtotime) y posteriormente da formato con date() la fecha y hora
     * 
     * Variables de retorno tipo fecha y hora por Payworks
     * Fecha: AAAAMMDD | Hora: HH:MM:SS.sss
     * 
     * Formato personalizado para guardar en MySQL
     * Fecha: YYYY-mm-dd | Hora: HH:ii:ss
     */
    public function marcaTiempo(string $nombre_campo, $predeterminado = null)
    {
        if(! in_array($nombre_campo, $this->campos_tiempo) )
            return false;

        if(! $fecha_hora_payworks = explode(' ', $this->campo($nombre_campo)) )
            return [];

        return [
            'fecha' => date('Y-m-d', strtotime($fecha_hora_payworks[0])),
            'hora' => date('H:i:s', strtotime($fecha_hora_payworks[1])),
        ];
    }

    public function fecha(string $nombre_campo, $predeterminado = null)
    {
        $marca_tiempo = $this->marcaTiempo($nombre_campo);
        return $marca_tiempo['fecha'] ?? $predeterminado;
    }

    public function hora(string $nombre_campo, $predeterminado = null)
    {
        $marca_tiempo = $this->marcaTiempo($nombre_campo);
        return $marca_tiempo['hora'] ?? $predeterminado;
    }

    public function explicacion()
    {
        return urldecode( $this->campo('TEXTO') );
    }


    // Validadores

    public function estaAutorizado()
    {
        return $this->resultado->estaAprobado();
    }
}


/*

* Variables de retorno

ID_AFILIACION 	- MERCHANT_ID
REFERENCIA 		- REFERENCE
NUMERO_CONTROL 	- CONTROL_NUMBER
FECHA_REQ_CTE 	- CUST_REQ_DATE 
FECHA_REQ_AUT 	- AUTH_REQ_DATE
FECHA_RSP_AUT 	- AUTH_RSP_DATE
FECHA_RSP_CTE 	- CUST_RSP_DATE
RESULTADO_PAYW 	- PAYW_RESULT
RESULTADO_AUT 	- AUTH_RESULT
CODIGO_PAYW 	- PAYW_CODE
CODIGO_AUT 		- AUTH_CODE
TEXTO 			- TEXT
TARJETAHABIENTE - CARD_HOLDER
BANCO_EMISOR 	- ISSUING_BANK
MARCA_TARJETA 	- CARD_BRAND
TIPO_TARJETA 	- CARD_TYPE


* Tipos de transacciones: pagina 12
Venta
Preautorización
Postautorización
Devolución referenciada (parcial o total)
Cancelación
Reversa


* Tipos de comandos: pagina 14


* Tipo de Transacción Original
Referencia
Tarjeta
Monto
Código Payworks
Resultado Payworks
Resultado Autorizador
Código Autorización
Fecha y hora transacción Banorte
Fecha y hora transacción Prosa
Fecha y hora salida transacción prosa
Fecha y hora salida transacción Banorte

Ejemplo: 
VTA|290444177992|49317223*****19|10.00|C|A|null|819509|20101122 11:48:39.652|null|null|20101122 11:48:39.762


* Referencias
REF_CLIENTE1
REF_CLIENTE2
REF_CLIENTE3
REF_CLIENTE4
REF_CLIENTE5


Tipos de Moneda
La afiliación únicamente puede ser configurada en pesos o dólares, no en los dos


Pagos Diferidos Q6
DIFERIMIENTO_INICIAL - INITIAL_DEFERMENT
NUMERO_PAGOS - PAYMENTS_NUMBER
TIPO_PLAN - PLAN_TYPE


Transacciones a modo de Prueba: pagina 16

*/

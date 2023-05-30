<?php

namespace App\Models\Factura;

use App\Outsourcing\Global\AtributosMagicosTrait;

class Vencimiento
{
    use AtributosMagicosTrait;

    /**
     * Constante númerico del ultimo día de febrero.
     * 
     * Si el fecha de vencimiento hace referencia al último dia del mes (6 => 30),
     * y si el mes es Febrero, se utiliza esta constante para evitar el día 30, en su lugar retrnoa 28
     * independiente si es año bisiesto.
     */
    const ULTIMO_DIA_FEBRERO = '28';
    
    /**
     * Claves del día de vencimiento provienen del modelo Ruta::CVE_VENC
     * Relacionado con el campo RUTA de Factura
     */
    public static $claves_dias = [
		1 => '05',
		2 => '10',
		3 => '15',
		4 => '20',
		5 => '25',
		6 => '30',
	];

    public $clave_dia;

    public $periodo;

    public function __construct(string $clave_dia, string $codigo_periodo)
    {
        $this->clave_dia = $clave_dia;

        $this->periodo = new Periodo($codigo_periodo);
    }


    // Attributes

    public function dia()
    {
        return $this->esUltimoDiaFebrero() ? self::ULTIMO_DIA_FEBRERO : self::obtenerDia($this->clave_dia);
    }

    public function fecha(string $concatenar = ' ', string $formato_mes = null, bool $anio_dos_digitos = false)
    {
        return implode($concatenar, [
            $this->dia,
            $this->periodo->formatoMes($formato_mes),
            $this->periodo->formatoAnio($anio_dos_digitos),
        ]);
    }


    // Validators

    public function esUltimoDiaFebrero()
    {
        return self::validarEsUltimoDiaFebrero($this->periodo->mes, $this->clave_dia);
    }

    /**
     * Verifica si la factura esta a tiempo para pago: vigente y atrasado
     * 
     * Fecha actual en segundos: strtotime('now')
     * Fecha limite en seguntos: strtotime( $this->fecha('-') )
     * 
     * @return boolean
     */
    public function estaTiempoPagar()
    {
        return strtotime('now') < strtotime( $this->fecha('-') );
    }


    // Static getters

    public static function obtenerDia($clave)
    {
        return array_key_exists($clave, self::$claves_dias) ? self::$claves_dias[$clave] : null;
    }

    /**
     * Comprueba el día y mes de vencimiento.
     * 
     * Si la $clave_o_dia es clave 6 ó dia 30 y si pertenece al periodo del mes Febrero... 
     * Hace referencia al dia 28 de Febrero, que es el último dia de este mes para
     * validar como "Vigente" independientemente si el año es bisiesto
     * 
     * @return boolean
     */
    public static function validarEsUltimoDiaFebrero($codigo_mes, $clave_o_dia)
    {
        return $codigo_mes == '02' && $clave_o_dia == 6 || $clave_o_dia == '30';
    }
}

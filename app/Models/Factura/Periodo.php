<?php

namespace App\Models\Factura;

use App\Outsourcing\Global\AtributosMagicosTrait;

class Periodo
{
    use AtributosMagicosTrait;
    
    const ANIO_INICIAL = 2015;

    private static $codigos_nombres_mes = [
        '01' => 'enero',
        '02' => 'febrero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'septiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre',
    ];

    /**
     * Código del periodo contiene 6 dígitos númericos.
     * 
     * Los primeros 4 dígitos son el año y los últimos 2 son el mes
     * Ejemplo: 202301 = 2023(Año) 01(Mes)
     */
    public $codigo_periodo;

    public function __construct(string $codigo_periodo)
    {
        $this->codigo_periodo = $codigo_periodo;
    }

    // Attributes

    // Año
    
    public function anio()
    {
        return self::obtenerAnio($this->codigo_periodo);
    }

    public function anio_dos_digitos()
    {
        return self::obtenerAnioDosDigitos($this->codigo_periodo);
    }


    // Mes

    public function mes()
    {
        return self::obtenerMes($this->codigo_periodo);
    }

    public function nombre_mes()
    {
        return self::obtenerNombreMes($this->codigo_periodo);
    }

    public function nombre_abreviado_mes()
    {
        return self::obtenerNombreAbreviadoMes($this->codigo_periodo);
    }


    // Getters

    public function formatoAnio(bool $dos_digitos)
    {
        return self::obtenerFormatoAnio($this->codigo_periodo, $dos_digitos);
    }

    public function formatoMes(string $formato = null)
    {
        return self::obtenerFormatoMes($this->codigo_periodo, $formato);
    }


    // Static getters

    // Año

    public static function obtenerAnio(string $codigo_periodo)
    {
        return substr($codigo_periodo, 0, 4);
    }

    public static function obtenerAnioDosDigitos(string $codigo_periodo)
    {
        $anio_cuatro_digitos = self::obtenerAnio($codigo_periodo);

        return substr($anio_cuatro_digitos, 2, 2);
    }

    public static function obtenerFormatoAnio(string $codigo_periodo, bool $dos_digitos)
    {
        return $dos_digitos ? self::obtenerAnioDosDigitos($codigo_periodo) : self::obtenerAnio($codigo_periodo);
    }


    // Mes

    public static function obtenerMes(string $codigo_periodo)
    {
        return substr($codigo_periodo, 4, 2);
    }

    public static function obtenerNombreMes(string $codigo_periodo)
    {
        $codigo_mes = self::obtenerMes($codigo_periodo);

        return array_key_exists($codigo_mes, self::$codigos_nombres_mes) ? self::$codigos_nombres_mes[$codigo_mes] : null;
    }

    public static function obtenerNombreAbreviadoMes(string $codigo_periodo)
    {
        $nombre_mes = self::obtenerNombreMes($codigo_periodo);

        return substr($nombre_mes, 0, 3);
    }

    public static function obtenerFormatoMes(string $codigo_periodo, string $formato = null)
    {
        if( $formato == 'nombre' )
            return self::obtenerNombreMes($codigo_periodo);

        if( $formato == 'abreviado' )
            return self::obtenerNombreAbreviadoMes($codigo_periodo);

        return self::obtenerMes($codigo_periodo);
    }


    // Asistentes

    public static function formatoCodigo($anio_cuatro_digitos, $codigo_mes)
    {
        return $anio_cuatro_digitos . $codigo_mes;
    }

    public static function obtenerRangoAnios()
    {
        return range(date('Y'), self::ANIO_INICIAL);
    }

    public static function obtenerCodigosMeses()
    {
        return self::$codigos_nombres_mes;
    }
}

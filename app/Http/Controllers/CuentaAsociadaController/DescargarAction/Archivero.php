<?php

namespace App\Http\Controllers\CuentaAsociadaController\DescargarAction;

use App\Models\Factura\Periodo;
use Illuminate\Http\Request;

class Archivero
{
    public static $contenedor_conceptos = [
        ComplementoDePago::class,
        ReciboDomiciliario::class,
    ];

    public $numero_cuenta;

    public $periodo;

    public function __construct($numero_cuenta, Request $request)
    {
        $this->numero_cuenta = $numero_cuenta;

        $this->periodo = Periodo::formatoCodigo(
            $request->get('anio', date('Y')), 
            $request->get('mes', date('m'))
        );
    }

    public function conceptos()
    {
        $conceptos = [];

        foreach(self::$contenedor_conceptos as $concepto)
            array_push($conceptos, new $concepto($this->numero_cuenta, $this->periodo));

        return $conceptos;
    }
}

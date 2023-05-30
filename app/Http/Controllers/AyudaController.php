<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AyudaController extends Controller
{
    public function __invoke()
    {
        return view('ayuda.index')->with('acordiones', [
            'pagar_en_linea' => ['tarjeta_bancaria', 'banorte'],
            'cuentas_asociadas' => ['ocupada','descargar_pdf_xml'],
            'tarjetas_bancarias' => ['no_verifica_autoriza', 'porque_actualizar'],
            'usuario' => ['actualizar'],
        ]);
    }
}

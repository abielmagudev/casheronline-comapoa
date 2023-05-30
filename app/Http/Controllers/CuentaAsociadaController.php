<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CuentaAsociadaController\DescargarAction\Archivero;
use App\Http\Requests\CuentaAsociadaStoreRequest;
use App\Models\CuentaAsociada;
use App\Models\Factura\Periodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaAsociadaController extends Controller
{
    public function index()
    {
        return view('cuentas_asociadas.index')->with('cuentas_asociadas', CuentaAsociada::autenticado()->with('padron')->get());
    }

    public function create()
    {
        return view('cuentas_asociadas.create');
    }

    public function store(CuentaAsociadaStoreRequest $request)
    {
        if(! $cuenta_asociada = CuentaAsociada::guardarRelacionDirecta( $request->get('numero') ) )
            return redirect()->route('cuentas_asociadas.create')->withInput()->with('danger', 'Intenta nuevamente agregar la cuenta asociada.');

        return redirect()->route('cuentas_asociadas.index')->with('success', "Cuenta asociada <b>{$cuenta_asociada->numero_nombre}</b>");
    }

    public function destroy($numero)
    {
        if(! $cuenta_asociada = CuentaAsociada::autenticado()->whereNumero( $numero )->first() )
            return redirect()->route('cuentas_asociadas.index')->with('danger', "Intenta remover una cuenta asociada válida");

        $numero_nombre = $cuenta_asociada->numero_nombre;

        if(! CuentaAsociada::autenticado()->whereNumero( $cuenta_asociada->numero )->delete() )
            return redirect()->route('cuentas_asociadas.index')->with('danger', "Intenta remover la cuenta asociada <b>{$numero_nombre}</b> nuevamente");
            
        return redirect()->route('cuentas_asociadas.index')->with('success', "Cuenta asociada <b>{$numero_nombre}</b> removida");
    }

    public function descargar(Request $request, $numero)
    {
        if(! $cuenta_asociada = CuentaAsociada::autenticado()->whereNumero( $numero )->first() )
            return redirect()->route('cuentas_asociadas.index')->with('danger', "Intenta descargar una cuenta asociada válida");

        return view('cuentas_asociadas.descargar',[
            'cuenta_asociada' => $cuenta_asociada,
            'archivero' => new Archivero($cuenta_asociada->numero, $request),
            'periodo' => [
                'meses' => Periodo::obtenerCodigosMeses(),
                'anios' => Periodo::obtenerRangoAnios(),
            ],
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\TarjetaBancariaSaveRequest;
use App\Models\MovimientoWeb;
use App\Models\TarjetaBancaria;
use App\Outsourcing\Banorte\ThreeDSecure\Mapa3DS;
use Illuminate\Database\Eloquent\Builder;

class TarjetaBancariaController extends Controller
{
    public function index()
    {
        $tarjetas_bancarias = TarjetaBancaria::decodificadas()
        ->withCount(['transacciones' => fn(Builder $query) => $query->where('resultadopay', 'A')])
        ->whereUsuario( auth()->user()->id )
        ->get();

        return view('tarjetas_bancarias.index', compact('tarjetas_bancarias'));
    }

    public function create()
    {
        return view('tarjetas_bancarias.create', [
            'anios' => TarjetaBancaria::obtenerRangoAnios(),
            'meses' => TarjetaBancaria::obtenerRangoMeses(),
            'redes' => TarjetaBancaria::CLAVES_NOMBRES_RED,
            'tipos' => TarjetaBancaria::CLAVES_NOMBRES_TIPO,
            'paises' => Mapa3DS::obtenerPaisesConEstados(),
            'tarjeta_bancaria' => new TarjetaBancaria,
            'patterns' => [
                'letras_espacios' => config('aplicacion.regex.letras_espacios'),
                'letras_numeros_espacios' => config('aplicacion.regex.letras_numeros_espacios'),
                'numero_tarjeta_bancaria' => config('aplicacion.regex.numero_tarjeta_bancaria'),
                'numeros' => config('aplicacion.regex.numeros'),
            ],
        ]);
    }

    public function store(TarjetaBancariaSaveRequest $request)
    {
        if(! $tarjeta_bancaria = TarjetaBancaria::guardar($request->validated()) )
            return back()->withInput()->with('danger', 'Intenta guardar la tarjeta bancaria nuevamente');

        MovimientoWeb::guardoTarjetaBancaria($tarjeta_bancaria->id);

        return redirect()->route('tarjetas_bancarias.index')->with('success', "Tarjeta bancaria {$tarjeta_bancaria->numero_discreto} guardada");
    }

    public function edit($id)
    {
        if(! $tarjeta_bancaria = TarjetaBancaria::decodificada($id)->whereUsuario( auth()->user()->id )->first() )
            return redirect()->route('tarjetas_bancarias.index')->with('danger', 'Selecciona una tarjeta bancaria válida');
        
        return view('tarjetas_bancarias.edit', [
            'anios' => TarjetaBancaria::obtenerRangoAnios(),
            'meses' => TarjetaBancaria::obtenerRangoMeses(),
            'redes' => TarjetaBancaria::CLAVES_NOMBRES_RED,
            'tipos' => TarjetaBancaria::CLAVES_NOMBRES_TIPO,
            'paises' => Mapa3DS::obtenerPaisesConEstados(),
            'tarjeta_bancaria' => $tarjeta_bancaria,
            'patterns' => [
                'letras_espacios' => config('aplicacion.regex.letras_espacios'),
                'letras_numeros_espacios' => config('aplicacion.regex.letras_numeros_espacios'),
                'numero_tarjeta_bancaria' => config('aplicacion.regex.numero_tarjeta_bancaria'),
                'numeros' => config('aplicacion.regex.numeros'),
            ],
        ]);
    }

    public function update(TarjetaBancariaSaveRequest $request, $id)
    {
        if(! TarjetaBancaria::wherePropietario($id, auth()->user()->id)->exists() )
            return redirect()->route('tarjetas_bancarias.index')->with('danger', 'Selecciona una tarjeta bancaria válida');

        if(! is_integer(TarjetaBancaria::actualizar($request->validated(), $id)) )
            return back()->with('danger', 'Intenta actualizar la tarjeta bancaria nuevamente');

        MovimientoWeb::actualizoTarjetaBancaria($id);

        return redirect()->route('tarjetas_bancarias.edit', $id)->with('success', 'Tarjeta bancaria actualizada');
    }

    public function destroy($id)
    {
        if(! $tarjeta_bancaria = TarjetaBancaria::decodificada($id)->whereUsuario( auth()->user()->id )->first() )
            return redirect()->route('tarjetas_bancarias.index')->with('danger', 'Selecciona una tarjeta bancaria válida');
        
        if(! $tarjeta_bancaria->delete() )
            return back()->with('danger', 'Intenta eliminar la tarjeta bancaria nuevamente');

        MovimientoWeb::eliminoTarjetaBancaria($id);

        return back()->with('success', "Tarjeta bancaria {$tarjeta_bancaria->numero_discreto} eliminada");
    }
}

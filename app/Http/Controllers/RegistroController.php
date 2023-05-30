<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistroStoreRequest;
use App\Mail\RegistradoMail;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;

class RegistroController extends Controller
{
    public function index()
    {
        return view('registro.index');
    }

    public function store(RegistroStoreRequest $request)
    {
        if(! $usuario = Usuario::guardar( $request->validated() ) )
            return redirect()->route('registro.index')->withInput()->with('danger', 'Intentamente registrarte nuevamente');

        Mail::to( $usuario->correo_electronico )->send( new RegistradoMail($usuario) );

        return redirect()->route('login')->with('success', 'Usuario registrado con éxito');
    }
}

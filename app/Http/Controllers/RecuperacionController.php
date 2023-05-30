<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecuperacionRegenerateRequest;
use App\Http\Requests\RecuperacionVerifyRequest;
use App\Mail\RecuperadoMail;
use App\Models\Usuario;
use Illuminate\Support\Facades\Mail;

class RecuperacionController extends Controller
{
    public function index()
    {
        return view('recuperacion.index');
    }

    public function verify(RecuperacionVerifyRequest $request)
    {
        return view('recuperacion.verified')->with('usuario', Usuario::whereCuenta($request->numero)->first());
    }

    public function generate(RecuperacionRegenerateRequest $request)
    {
        Usuario::generarContrasenaTemporalPorNumeroCuenta($request->cuenta);
        
        $usuario = Usuario::decodificado($request->cuenta, 'cuenta')->first();

        Mail::to($usuario->correo_electronico)->send( new RecuperadoMail($usuario) );

        return redirect()->route('login')->with('success', 'Revisa las instrucciones que se enviaron al correo electrónico');
    }
}

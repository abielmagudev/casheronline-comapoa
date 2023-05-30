<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutenticacionRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{
    public function login()
    {
        return view('autenticacion.login');
    }

    public function entering(AutenticacionRequest $request)
    {
        $usuario = Usuario::decodificado($request->usuario, 'usuario')->first();

        if( is_null($usuario) || $usuario->contrasena_decodificada <> $request->contrasena )
            return back()->with('danger', 'Usuario ó contraseña incorrectos');

        Auth::login($usuario);

        return redirect()->route('pagar.index');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Session::flush();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
     
        return redirect()->route('login')->with('success', 'Sesión terminada');
    }
}

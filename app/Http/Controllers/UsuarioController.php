<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioContrasenaUpdateRequest;
use App\Http\Requests\UsuarioIdentificacionUpdateRequest;
use App\Models\Usuario;
class UsuarioController extends Controller
{
    public function edit($id = null)
    {
        return view('usuario.edit');
    }

    public function updateIdentificacion(UsuarioIdentificacionUpdateRequest $request)
    {
        $preparados = Usuario::prepararParaActualizarIdentificacion($request->validated());

        Usuario::actualizar($preparados) 
            ? session()->flash('success', 'Identificación de usuario actualizada') 
            : session()->flash('danger', 'Intenta actualizar la identificación de usuario nuevamente');
        
        return redirect()->route('usuario.edit');
    }

    public function updateContrasena(UsuarioContrasenaUpdateRequest $request)
    {
        $preparados = Usuario::prepararParaActualizarContrasena($request->validated());

        Usuario::actualizar($preparados)
            ? session()->flash('success', 'Contraseña de usuario actualizada') 
            : session()->flash('danger', 'Intenta actualizar la contraseña de usuario nuevamente');
        
        return redirect( implode([route('usuario.edit'), '#contrasena']) );
    }
}

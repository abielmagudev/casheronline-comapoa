<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Usuario;

class AutenticacionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'usuario' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.nombre_usuario')),
                // sprintf('exists:%s,usuario', Usuario::class),
            ],
            'contrasena' => [
                'required',
            ],
        ];
    }

    /**
     * Despúes de la validación, si hay errores crea una notificación 
     * al usuario para autenticarse nuevamente
     */
    public function withValidator($validator)
    {
        if( $validator->fails()  )
            session()->flash('danger', 'Usuario o contraseña incorrectos');
    }
}

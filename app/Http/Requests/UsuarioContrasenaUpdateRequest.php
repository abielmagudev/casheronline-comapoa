<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioContrasenaUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contrasena_actual' => [
                'bail',
                'required',
                function ($attribute, $value, $fail) {
                    $autenticado = Usuario::decodificado(Auth::id())->first();

                    if( $value <> $autenticado->contrasena_decodificada )
                        $fail('Escribe correctamente la contraseña actual');
                },
            ],
            'nueva_contrasena' => [
                'required',
            ],
            'confirmar_nueva_contrasena' => [
                'required',
                'same:nueva_contrasena',
            ],
        ];
    }

    public function messages()
    {
        return [
            'contrasena_actual.required' => __('Escribe la contraseña actual'),
            'nueva_contrasena.required' => __('Escribe la nueva contraseña'),
            'confirmar_nueva_contrasena.required' => __('Escribe la confirmación de la nueva contraseña'),
            'confirmar_nueva_contrasena.same' => __('Escribe la misma nueva contraseña'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() )
            $this->redirect = implode([route('usuario.edit'), '#contrasena']);
    }
}

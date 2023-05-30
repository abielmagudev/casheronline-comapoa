<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UsuarioIdentificacionUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => [
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.letras_numeros_espacios')),
            ],
            'correo_electronico' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,%s,%s', Usuario::class, 'email', Auth::id()),
            ],
            'usuario' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.nombre_usuario')),
                sprintf('unique:%s,%s,%s', Usuario::class, 'usuario', Auth::id()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => __('Escribe el nombre personal ó compañia'),
            'nombre.regex' => __('Escribe un nombre personal ó compañia válido'),
            'correo_electronico.required' => __('Escribe el correo electrónico'),
            'correo_electronico.email' => __('Escribe un correo electrónico válido'),
            'correo_electronico.unique' => __('Escribe otro correo electrónico no registrado'),
            'usuario.required' => __('Escribe el nombre de usuario'),
            'usuario.regex' => __('Escribe un nombre de usuario válido'),
            'usuario.unique' => __('Escribe otro nombre de usuario no registrado'),
            'actualizar.required' => __('Selecciona una opción válida para actualizar'),
            'actualizar.in' => __('Selecciona una opción válida para actualizar'),
        ];
    }
}

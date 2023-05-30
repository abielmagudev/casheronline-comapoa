<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use App\Models\Padron;
use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;

class RegistroStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero_cuenta' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.numero_cuenta')),
                sprintf('exists:%s,CUENTA', Padron::class),
                sprintf('unique:%s,cuenta', CuentaAsociada::class)
            ],
            'nombre_cuenta' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.nombre_cuenta')),
                sprintf('exists:%s,NOMBRE,CUENTA,%s', Padron::class, $this->get('numero_cuenta', 'x')),
            ],
            'nombre' => [
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.letras_numeros_espacios')),
            ],
            'correo_electronico' => [
                'bail',
                'required',
                'email',
                sprintf('unique:%s,email', Usuario::class),
            ],
            'usuario' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.usuario')),
                sprintf('unique:%s,usuario', Usuario::class),
            ],
            'contrasena' => [
                'required',
                'min:6'
            ],
            'confirmar_contrasena' => [
                'required',
                'same:contrasena',
            ],
            'acepto_terminos_condiciones' => [
                'required',
                'accepted',
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero_cuenta.required' => __('Escribe el número de cuenta'),
            'numero_cuenta.regex' => __('Escribe un número de cuenta válido'),
            'numero_cuenta.exists' => __('Escribe un número de cuenta existente'),
            'numero_cuenta.unique' => __('Escribe un número de cuenta que no este registrado'),
            'nombre_cuenta.required' => __('Escribe el nombre de la cuenta'),
            'nombre_cuenta.regex' => __('Escribe un nombre de cuenta válido'),
            'nombre_cuenta.exists' => __('Escribe un nombre de cuenta existente'),
            'nombre.required' => __('Escribe el nombre ó compañia'),
            'nombre.regex' => __('Escribe letras, números y espacios'),
            'correo_electronico.required' => __('Escribe el correo electrónico'),
            'correo_electronico.email' => __('Escribe un correo electrónico válido'),
            'correo_electronico.unique' => __('Escribe un correo electrónico diferente'),
            'usuario.required' => __('Escribe el usuario'),
            'usuario.regex' => __('Escribe un usuario válido'),
            'usuario.unique' => __('Escribe un usuario diferente'),
            'contrasena.required' => __('Escribe la contraseña'),
            'contrasena.min' => __('Escribe una contraseña válida'),
            'confirmar_contrasena.required' => __('Escribe la confirmación contraseña'),
            'confirmar_contrasena.same' => __('Escribe la misma contraseña para confirmar'),
            'acepto_terminos_condiciones.required' => __('Activa la casilla de "terminos y condiciones"'),
            'acepto_terminos_condiciones.accepted' => __('Activa una casilla válida de "terminos y condiciones"'),
        ];
    }
}

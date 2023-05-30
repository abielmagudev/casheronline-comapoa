<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use App\Models\Padron;
use Illuminate\Foundation\Http\FormRequest;

class RecuperacionVerifyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.nombre_cuenta')),
                sprintf('exists:%s,NOMBRE,CUENTA,%s', Padron::class, $this->numero),
            ],
            'numero' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.numero_cuenta')),
                sprintf('exists:%s,cuenta', CuentaAsociada::class),
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => __('Escribe el nombre de la cuenta'),
            'nombre.regex' => __('Escribe un nombre válido de la cuenta'),
            'nombre.exists' => __('Escribe un número y nombre de cuenta válido'),
            'numero.required' => __('Escribe el número de cuenta'),
            'numero.regex' => __('Escribe un número de cuenta válido'),
            'numero.exists' => __('Escribe un número de cuenta que haya sido registrado'),
        ];
    }
}

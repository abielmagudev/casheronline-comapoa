<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Padron;
class CuentaAsociadaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.numero_cuenta')),
                'unique:usuarios,cuenta',
                'unique:cuentas,cuenta',
            ],
            'nombre' => [
                'bail',
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.nombre_cuenta')),
                sprintf('exists:%s,NOMBRE,CUENTA,%s', Padron::class, $this->numero),
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => __('Escribe el número de cuenta'),
            'numero.regex' => __('Escribe un número válido de cuenta'),
            'numero.unique' => __('Escribe otro número de cuenta que no este asociado'),
            'nombre.required' => __('Escribe el nombre de la cuenta'),
            'nombre.regex' => __('Escribe un nombre válido de la cuenta'),
            'nombre.exists' => __('Escribe un nombre que corresponda a la cuenta'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'numero' => trim($this->numero) ?? null,
            'nombre' => trim( strtoupper($this->nombre) ) ?? null,
        ]);
    }
}

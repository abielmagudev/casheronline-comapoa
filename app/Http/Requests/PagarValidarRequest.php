<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use App\Models\TarjetaBancaria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PagarValidarRequest extends FormRequest
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
                sprintf('exists:%s,cuenta,id_usuario,%s', CuentaAsociada::class, Auth::id()),
            ],
            'tarjeta_bancaria' => [
                'bail',
                'required',
                sprintf('exists:%s,id,id_web,%s', TarjetaBancaria::class, Auth::id()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero_cuenta.required' => __('Selecciona la cuenta asociada para pagar'),
            'numero_cuenta.regex' => __('Selecciona una cuenta asociada válida para pagar'),
            'numero_cuenta.exists' => __('Selecciona una cuenta asociada válida para verificar'),
            'tarjeta_bancaria.required' => __('Selecciona la tarjeta bancaria para verificar'),
            'tarjeta_bancaria.exists' => __('Selecciona una tarjeta bancaria válida para verificar'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'numero_cuenta' => $this->numero_cuenta ?? null,
        ]);
    }

    public function withValidator($validator)
    {
        if( $validator->fails()  )
            session()->flash('danger', $validator->errors()->first());
    }
}

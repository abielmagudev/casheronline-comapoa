<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use App\Models\Transaccion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PagarProcesarRequest extends FormRequest
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
            'id_transaccion' => [
                'bail',
                'required',
                sprintf('exists:%s,id,id_usuario,%s,cuenta,%s,resultadopay,NULL', Transaccion::class, Auth::id(), $this->numero_cuenta),
            ],
            'codigo_verificacion' => [
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.cvv')),
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero_cuenta.required' => __('Selecciona el número de cuenta para autorizar el pago'),
            'numero_cuenta.regex' => __('Selecciona un número de cuenta válida para autorizar el pago'),
            'numero_cuenta.exists' => __('Selecciona un número de cuenta asociada válida para autorizar el pago'),
            'id_transaccion.required' => __('Continua con un pago disponible ó una tarjeta bancaria validada'),
            'id_transaccion.exists' => __('Pago no disponible ó tarjeta bancaria no validada'),
            'codigo_verificacion.required' => __('Escribe el código de verificación de la tarjeta bancaria validada'),
            'codigo_verificacion.regex' => __('Escribe un código de verificación válido de la tarjeta bancaria validada'),
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'numero_cuenta' => $this->numero_cuenta ?? null,
            'id_transaccion' => $this->id_transaccion ?? null,
        ]);
    }

    public function withValidator($validator)
    {
        if( $validator->fails() )
            session()->flash('danger', $validator->errors()->first());

        if(! $validator->errors()->has('codigo_verificacion') )
            $this->redirect = route('pagar.index');
    }
}

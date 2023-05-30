<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use App\Models\Transaccion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PagarAutorizarRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'numero_cuenta.required' => __('Selecciona el número de cuenta para continuar con el pago'),
            'numero_cuenta.regex' => __('Selecciona un número de cuenta válida para continuar con el pago'),
            'numero_cuenta.exists' => __('Selecciona un número de cuenta asociada válida para continuar con el pago'),
            'id_transaccion.required' => __('Continua con un pago disponible ó una tarjeta bancaria validada para continuar'),
            'id_transaccion.exists' => __('Pago no disponible ó tarjeta bancaria no validada para continuar'),
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
        if( $validator->fails()  )
        {
            session()->flash('danger', $validator->errors()->first());
            $this->redirect = route('pagar.index');
        }
    }
}

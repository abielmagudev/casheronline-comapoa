<?php

namespace App\Http\Requests;

use App\Models\CuentaAsociada;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PagarCrearRequest extends FormRequest
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
                sprintf('exists:%s,cuenta,id_usuario,%s', CuentaAsociada::class, Auth::id()),
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero_cuenta.required' => __('Selecciona la cuenta asociada a pagar'),
            'numero_cuenta.exists' => __('Selecciona una cuenta asociada válida a pagar'),
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
        {
            session()->flash('danger', $validator->errors()->first());
            $this->redirect = route('pagar.index');
        }
    }
}

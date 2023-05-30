<?php

namespace App\Http\Requests;

use App\Models\Usuario;
use Illuminate\Foundation\Http\FormRequest;

class RecuperacionRegenerateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'correo_electronico' => [
                'required',
                'email',
                sprintf('exists:%s,email,cuenta,%s', Usuario::class, $this->cuenta),
            ],
        ];
    }

    public function messages()
    {
        return [
            'correo_electronico.required' => __('Escribe el correo electrónico'),
            'correo_electronico.email' => __('Escribe un correo electrónico válido'),
            'correo_electronico.exists' => __('Escribe un correo electrónico existente'),
        ];
    }

    public function withValidator($validator)
    {
        if( $validator->fails() )
        {
            $this->redirect = route('recuperacion.index');
            session()->flash('danger', 'Intenta de nuevo escribir correctamente el correo electrónico para la recuperación de usuario');
        }
    }
}

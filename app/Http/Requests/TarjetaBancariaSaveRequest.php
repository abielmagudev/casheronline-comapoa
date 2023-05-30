<?php

namespace App\Http\Requests;

use App\Models\TarjetaBancaria;
use App\Outsourcing\Banorte\ThreeDSecure\Mapa3DS;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class TarjetaBancariaSaveRequest extends FormRequest
{
    public $numero_rules, $cache_rules;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'numero' => $this->numero_rules,
            'mes' => [
                'required',
                sprintf('in:%s', TarjetaBancaria::obtenerRangoMeses(',')),
            ],
            'anio' => [
                'required',
                sprintf('in:%s', TarjetaBancaria::obtenerRangoAnios(',')),
            ],
            'tipo' => [
                'required',
                sprintf('in:%s', TarjetaBancaria::obtenerClavesTipo(',')),
            ],
            'red' => [
                'required',
                sprintf('in:%s', TarjetaBancaria::obtenerClavesRed(',')),
            ],
            'nombre' => [
                'required',
                sprintf('regex:/%s/', $this->cache_rules['regex.letras_espacios']),
            ],
            'apellido' => [
                'required',
                sprintf('regex:/%s/', $this->cache_rules['regex.letras_espacios']),
            ],
            'calle' => [
                'required',
                sprintf('regex:/%s/', config('aplicacion.regex.letras_numeros_espacios')),
            ],
            'codigo_postal' => [
                'required',
                sprintf('regex:/%s/', $this->cache_rules['regex.numeros']),
            ],
            'pais' => [
                'required',
                sprintf('in:%s', Mapa3DS::obtenerCodigosPaises(',')),
            ],
            'estado' => [
                'required',
                sprintf('in:%s', $this->cache_rules['list.codigos_estados']),
            ],
            'ciudad' => [
                'required',
                sprintf('regex:/%s/', $this->cache_rules['regex.letras_espacios']),
            ],
            'numero_celular' => [
                'required',
                sprintf('regex:/%s/', $this->cache_rules['regex.numeros']),
            ],
            'correo' => [
                'required',
                'email',
            ],
            'copia' => [
                'sometimes',
                'accepted',
            ],
        ];
    }

    public function messages()
    {
        return [
            'numero.required' => __('Escribe el número con 16 dígitos'),
            'numero.regex' => __('Escribe un número válido con 16 dígitos'),
            'mes.required' => __('Selecciona el mes'),
            'mes.in' => __('Selecciona un mes válido'),
            'anio.required' => __('Selecciona el año'),
            'anio.in' => __('Selecciona un año válido'),
            'tipo.required' => __('Selecciona el tipo'),
            'tipo.in' => __('Selecciona un tipo válido'),
            'red.required' => __('Selecciona la red'),
            'red.in' => __('Selecciona una red válida'),
            'nombre.required' => __('Escribe el nombre'),
            'nombre.regex' => __('Escribe un nombre válido'),
            'apellido.required' => __('Escribe el apellido'),
            'apellido.regex' => __('Escribe un apellido válido'),
            'calle.required' => __('Escribe la calle y el número'),
            'calle.regex' => __('Escribe una calle y un número válido'),
            'codigo_postal.required' => __('Escribe el código postal'),
            'codigo_postal.regex' => __('Escribe un código postal válido'),
            'pais.required' => __('Selecciona el país'),
            'pais.in' => __('Selecciona un país válido'),
            'estado.required' => __('Selecciona el estado'),
            'estado.in' => __('Selecciona un estado válido'),
            'ciudad.required' => __('Escribe la ciudad'),
            'ciudad.regex' => __('Escribe una ciudad válida'),
            'numero_celular.required' => __('Escribe el número de celular'),
            'numero_celular.regex' => __('Escribe un número de celular válido'),
            'correo.required' => __('Escribe el correo electrónico'),
            'correo.email' => __('Escribe un correo electrónico válido'),
            'copia.accepted' => __('Activa o desactiva la casilla válida de "copia de transacción"'),
        ];
    }

    public function prepareForValidation()
    {
        $this->numero_rules = $this->isMethod('post') ? ['required'] : ['nullable'];
        $this->numero_rules[] = sprintf('regex:/%s/', config('aplicacion.regex.numero_tarjeta_bancaria'));

        $this->cache_rules = [
            'list.codigos_estados' => implode(',', Mapa3DS::obtenerCodigosEstados($this->pais)),
            'regex.letras_espacios' => config('aplicacion.regex.letras_espacios'),
            'regex.numeros' => config('aplicacion.regex.numeros'),
        ];

        $this->merge([
            'apellido' => Str::title( trim($this->apellido) ),
            'calle' => Str::title( trim($this->calle) ),
            'ciudad' => Str::title( trim($this->ciudad) ),
            'nombre' => Str::title( trim($this->nombre) ),
        ]);
    }

    public function withValidator($validator)
    {
        if( $validator->fails() )
            session()->flash('danger', 'Revisa la información nuevamente');
    }
}

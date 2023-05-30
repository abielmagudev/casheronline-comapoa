@extends('aplicacion')
@section('contenido')
@include('tarjetas_bancarias._reglas-formulario')
<div class="card shadow">
    <div class="card-header py-3">
        <b class='text-uppercase'>Editar tarjeta bancaria</b>
    </div>
    <div class="card-body">
        <form action="{{ route('tarjetas_bancarias.update', $tarjeta_bancaria->id) }}" method="post">
            @include('tarjetas_bancarias._form')
            <div class="text-end">
                <button class='btn btn-warning'>Actualizar tarjeta bancaria</button>
                <a href="{{ route('tarjetas_bancarias.index') }}" class="btn btn-primary">Regresar</a>
            </div>
            @method('patch')
            @csrf
        </form>
    </div>
</div>
<br>
@include('tarjetas_bancarias._modal-informacion')
@include('tarjetas_bancarias._script_paises_estados')
@include('components.script-remove-invalid')
@endsection

@extends('aplicacion')
@section('contenido')
@include('tarjetas_bancarias._reglas-formulario')
<div class="card shadow">
    <div class="card-header py-3">
        <b class='text-uppercase'>Nueva tarjeta bancaria</b>
    </div>
    <div class="card-body">
        <form action="{{ route('tarjetas_bancarias.store') }}" method="post">
            @include('tarjetas_bancarias._form')
            <div class="text-end">
                <button class='btn btn-success'>Guardar tarjeta bancaria</button>
                <a href="{{ route('tarjetas_bancarias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
            @csrf
        </form>
    </div>
</div>
<br>
@include('tarjetas_bancarias._modal-informacion')
@include('tarjetas_bancarias._script_paises_estados')
@include('components.script-remove-invalid')
@endsection

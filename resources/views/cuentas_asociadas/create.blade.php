@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <b class="text-uppercase">Agregar cuenta asociada</b>
    </div>
    <div class="card-body">
        <form action="{{ route('cuentas_asociadas.store') }}" method='post' autocomplete="off">
            <div class="mb-3">
                <label for="inputNumero" class="form-label">Número de cuenta</label>
                <input type="text" class="form-control @error('numero') is-invalid @enderror" id="inputNumero" name='numero' value="{{ old('numero') }}" maxlength="6" pattern="{{ config('aplicacion.regex.numero_cuenta') }}" autofocus required>
                <x-error name='numero'></x-error>
            </div>
            <div class="mb-3">
                <label for="inputNombre" class="form-label">Nombre de la cuenta</label>
                <input type="text" class="form-control script-uppercase @error('nombre') is-invalid @enderror" id="inputNombre" name='nombre' value="{{ old('nombre') }}" pattern="{{ config('aplicacion.regex.nombre_cuenta') }}" required>
                <x-error name='nombre'></x-error>
            </div>
            <div class="text-end">
                <button class="btn btn-success">Guardar cuenta asociada</button>
                <a href="{{ route('cuentas_asociadas.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
            @csrf
        </form>
    </div>
</div>
@include('components.script-uppercase')
@include('components.script-remove-invalid')
@endsection

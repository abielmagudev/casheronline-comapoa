@extends('aplicacion')
@section('contenido')
<div class="text-center">
    <img class="img-fluid" width="256" src="{{ asset('imagenes/logoComapaBlancoPequeno.png') }}" alt="COMAPA NUEVO LAREDO">
</div>
<br>
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-sm-4">
        <x-notification />
        <div class="card shadow">
            <div class="card-header">
                <b class="text-uppercase">Recuperación</b>
            </div>
            <div class="card-body">
                <form action="{{ route('recuperacion.verify') }}" method="post">
                    <div class="mb-3">
                        <label for="inputNumeroCuenta" class="form-label">Número de cuenta principal <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control" id="inputNumeroCuenta" name="numero" pattern="{{ config('aplicacion.regex.numero_cuenta') }}" placeholder='Solo 6 números' autofocus required>
                        <x-error name='numero' />
                    </div>
                    <div class="mb-3">
                        <label for="inputNombreCuenta" class="form-label">Nombre de la cuenta principal <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control" id="inputNombreCuenta" name="nombre" pattern="{{ config('aplicacion.regex.nombre_cuenta') }}" placeholder='Letras y espacios' required>
                        <x-error name='nombre' />
                    </div>
                    @csrf
                    <button class="btn btn-success w-100">Buscar cuenta principal registrada</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<center class='text-white'>¿Recordaste tu usuario y contraseña? <a href="{{ route('login') }}" style="color:<?= $colores->link_light ?>">Iniciar sesión</a></center>
<br>
@endsection

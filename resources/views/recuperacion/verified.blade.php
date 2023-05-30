@extends('aplicacion')
@section('contenido')
<div class="text-center">
    <img class="img-fluid" width="256" src="{{ asset('imagenes/logoComapaBlancoPequeno.png') }}" alt="COMAPA NUEVO LAREDO">
</div>
<br>
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-sm-4">
        <div class="card shadow">
            <div class="card-header">
                <b class="text-uppercase">Recuperación</b>
            </div>
            <div class="card-body">
                <p>Escribe la dirección del correo electrónico que registraste con tu cuenta principal.</p>
                <form action="{{ route('recuperacion.generate') }}" method="post" class='mb-3'>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="inputNombreCuenta" name="correo_electronico" placeholder="{{ $usuario->nombre_discreto_correo_electronico }}" required>
                    </div>
                    <div data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Este proceso puede demorar algunos minutos">
                        <button class="btn btn-success w-100" name="cuenta" value="{{ $usuario->numero_cuenta_principal }}">Enviar instrucciones a este correo electrónico</button>
                    </div>
                    @method('patch')
                    @csrf
                </form>
            </div>
        </div>
        <br>
        <center class='text-white'>¿Recordaste tu usuario y contraseña? <a href="{{ route('login') }}" style="color:<?= $colores->link_light ?>">Iniciar sesión</a></center>
    </div>
</div>
@endsection

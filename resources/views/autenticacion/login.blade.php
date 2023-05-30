@extends('aplicacion')
@section('contenido')
<div class="text-center">
    <img class="img-fluid" width="256" src="{{ asset('imagenes/logoComapaBlancoPequeno.png') }}" alt="COMAPA NUEVO LAREDO">
</div>
<br>
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-lg-4">
        <x-notification />
        <div class="card shadow">
            <div class="card-header">
                <b class="text-uppercase">{{ config('app.name') }}</b>
            </div>
            <div class="card-body">
                <form action="{{ route('entering') }}" method="post">
                    <div class="mb-3">
                        <label for="inputUsuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="inputUsuario" name="usuario" value="{{ old('usuario') }}" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="inputContrasena" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="inputContrasena" name="contrasena" required>
                            <button class="btn btn-outline-secondary revelador" data-secreto="inputContrasena" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>  
                    </div>
                    <button class="btn btn-success w-100" type="submit">Iniciar sesión</button>
                    @csrf
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('recuperacion.index') }}" class="card-link">¿Olvidaste tu usuario ó contraseña?</a>
            </div>
        </div>
    </div>
</div>
<br>
<center>
    <p class='text-white'>¿No tienes usuario? <a href="{{ route('registro.index') }}" style="color:<?= $colores->link_light ?>">Registrate aquí</a></p>
    <br>
    <small class='text-white'>Por seguridad y compatibilidad, utiliza algúno de estos navegadores</small>
    <div class="small">
        <a href="https://www.google.com/chrome/" target="_blank" style="color:<?= $colores->link_light ?>">Google Chrome</a>
        <a href="https://www.microsoft.com/edge" target="_blank" style="color:<?= $colores->link_light ?>">Microsoft Edge</a>
        <a href="https://www.mozilla.org/firefox/new/" target="_blank" style="color:<?= $colores->link_light ?>">Mozilla Firefox</a>
        <a href="https://www.apple.com/safari/" target="_blank" style="color:<?= $colores->link_light ?>">Apple Safari</a>
    </div>
</center>
<br>
<x-script-reveal-secret-click />
@endsection

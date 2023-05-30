@extends('aplicacion')
@section('contenido')
<div class="text-center">
    <img class="img-fluid" width="256" src="{{ asset('imagenes/logoComapaBlancoPequeno.png') }}" alt="COMAPA NUEVO LAREDO">
</div>
<br>
<div class="row justify-content-center">
    <div class='col-md col-md-10 col-lg-6'>
        <x-notification />
        <div class="card shadow">
            <div class="card-header">
                <span class='fw-bold text-uppercase'>Registro</span>
            </div>
            <div class="card-body">
                <form action="{{ route('registro.store') }}" method="post">
                    <div class="mb-3">
                        <label for="inputNumeroCuenta" class="form-label">Número de cuenta principal <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control" id="inputNumeroCuenta" name="numero_cuenta" value="{{ old('numero_cuenta') }}" pattern="{{ config('aplicacion.regex.numero_cuenta') }}" autofocus required>
                        <x-error name='numero_cuenta'>
                            <small id="inputNumeroCuentaAyuda" class="form-text">Los 6 números que se muestran en el recibo.</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="inputNombreCuenta" class="form-label">Nombre de la cuenta principal <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control script-uppercase" id="inputNombreCuenta" name="nombre_cuenta" value="{{ old('nombre_cuenta') }}" pattern="{{ config('aplicacion.regex.nombre_cuenta') }}" required>
                        <x-error name='nombre_cuenta'>
                            <small id="inputNombreCuentaAyuda" class="form-text">Corresponda al número de cuenta principal</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="inputNombre" class="form-label">Nombre personal o compañia <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control" id="inputNombre" name="nombre" value="{{ old('nombre') }}" pattern="{{ config('aplicacion.regex.letras_numeros_espacios') }}" required>
                        <x-error name='nombre'>
                            <small id="inputNombreAyuda" class="form-text">Solo letras, números y espacios</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="emailCorreoElectronico" class="form-label">Correo electrónico <b class='text-danger'>*</b></label>
                        <input type="email" class="form-control" id="emailCorreoElectronico" name="correo_electronico" value="{{ old('correo_electronico') }}" required>
                        <x-error name='correo_electronico'>
                            <small id="emailCorreoElectronicoAyuda" class="form-text">Para recibir notificaciones de la plataforma</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="inputUsuario" class="form-label">Usuario <b class='text-danger'>*</b></label>
                        <input type="text" class="form-control" id="inputUsuario" name="usuario" value="{{ old('usuario') }}" pattern="{{ config('aplicacion.regex.usuario') }}" required>
                        <x-error name='usuario'>
                            <small id="inputUsuarioAyuda" class="form-text">De 6 a 12 caractéres (Guion bajo, letra ó númerico)</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="passwordContrasena" class="form-label">Contraseña <b class='text-danger'>*</b></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passwordContrasena" name="contrasena" minlength='6' required>
                            <button class="btn btn-outline-secondary revelador" data-secreto="passwordContrasena" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <x-error name='contrasena'>
                            <small id="passwordContrasenaAyuda" class="form-text">Mínimo 6 caracterés</small>
                        </x-error>
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmarContrasena" class="form-label">Confirmar contraseña <b class='text-danger'>*</b></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passwordConfirmarContrasena" name="confirmar_contrasena" minlength='6' required>
                            <button class="btn btn-outline-secondary revelador" data-secreto="passwordConfirmarContrasena" type="button">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <x-error name='confirmar_contrasena'>
                            <small id="passwordConfirmarContrasenaAyuda" class="form-text">Exáctamente como el campo 'Contraseña'</small>
                        </x-error>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Acepta los términos y condiciones <b class='text-danger'>*</b></label>
                        <div class="p-3 border rounded">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name='acepto_terminos_condiciones' value="1" id="checkboxAceptoTerminosCondiciones" checked required>
                                <label class="form-check-label" for="checkboxAceptoTerminosCondiciones">Si acepto los <a href="#!" data-bs-toggle="modal" data-bs-target="#terminosCondicionesModal">términos y condiciones</a> que se mencionan.</label>
                            </div>
                        </div>
                        <x-error name='acepto_terminos_condiciones' />
                    </div>
                    @csrf
                    <button class="btn btn-success w-100">Registrar usuario para cuenta principal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<center class='text-white'>¿Ya estas registrado? <a href="{{ route('login') }}" style="color:<?= $colores->link_light ?>">Iniciar sesión</a></center>
<br>
@include('componentes.modal-terminos-condiciones')
<x-script-uppercase />
<x-script-remove-invalid />
<x-script-reveal-secret-click />
@endsection

@extends('disenos.email')
@section('contenido')
<h1 style='margin:0'>Recuperación de usuario</h1>
<p class='subtitle'>Se ha generado una contraseña temporal para acceder a "Paga en línea" con tu usuario.</p>
<p style="margin-top:2rem">
    <b><span style="color:red">***</span> ACTUALIZA INMEDIATAMENTE TU CONTRASEÑA POR SEGURIDAD. <span style="color:red">***</span></b>
</p>
<div class="notification-success">
    <h3 style="margin-top:0">USUARIO RECUPERADO</h3>
    <p>
        <small>NÚMERO Y NOMBRE DE LA CUENTA PRINCIPAL</small>
        <br>
        <b>{{ $usuario->cuenta_principal->numero_cuenta }} - {{ $usuario->cuenta_principal->nombre_completo }}</b>
    </p>
    <p>
        <small>USUARIO</small>
        <br>
        <b>{{ $usuario->nombre_usuario }}</b>
    </p>
    <p>
        <small>CONTRASEÑA TEMPORAL</small>
        <br>
        <b>{{ $usuario->contrasena_decodificada }}</b>
    </p>
</div>
@include('emails._pie')
@endsection

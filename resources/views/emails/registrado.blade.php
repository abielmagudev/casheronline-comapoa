@extends('disenos.email')
@section('contenido')
<h1 style="margin:0">Bienvenido a "Paga en línea"</h1>
<p class='subtitle'>Tu usuario ha sido registrado satisfactoriamente en nuestro servicio web.</p>
<div class="notification-success">
    <h3 style="margin-top:0">USUARIO RECUPERADO</h3>
    <p>
        <small>NÚMERO Y NOMBRE DE LA CUENTA PRINCIPAL</small>
        <br>
        <b>{{ $usuario->cuenta_principal->numero_nombre_cuenta }}</b>
    </p>
    <p>
        <small>USUARIO</small>
        <br>
        <b>{{ $usuario->nombre_usuario }}</b>
    </p>
</div>
@include('emails._pie')
@endsection

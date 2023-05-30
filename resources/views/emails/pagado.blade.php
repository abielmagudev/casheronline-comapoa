@extends('disenos.email')
@section('contenido')
<h1 class='title'>Gracias por tu pago en línea</h1>
<p class='subtitle'>El pago fue autorizado y confirmado por el banco emisor de tu tarjeta bancaria.</p>
<div class="notification-success text-uppercase">
    <p>
        <small>NÚMERO Y NOMBRE DE LA CUENTA</small>
        <br>
        <b>{{ $transaccion->padron->numero_cuenta }} - {{ $transaccion->padron->nombre_completo }}</b>
    </p>
    <p>
        <small>PERIODO</small>
        <br>
        <b>{{ $vencimiento->fecha(' ', 'nombre') }}</b>
    </p>
    <p>
        <small>MONTO</small>
        <br>
        <b>${{ $transaccion->monto_con_separador }}</b>
    </p>
    <p>
        <small>TARJETA BANCARIA</small>
        <br>
        <b>{{ $transaccion->tarjeta_bancaria->nombre_red }} {{ $transaccion->tarjeta_bancaria->numero_discreto }} ({{ $transaccion->tarjeta_bancaria->expira }})</b>
    </p>
    <p>
        <small>CÓDIGO DE AUTORIZACIÓN</small>
        <br>
        <b>{{ $transaccion->codigo_autorizacion_payworks }}</b>
    </p>
    <p>
        <small>NÚMERO DE REFERENCIA</small>
        <br>
        <b>{{ $transaccion->referencia_payworks }}</b>
    </p>
    <p>
        <small>FECHA HORA DE TRANSACCIÓN</small>
        <br>
        <b>{{ $transaccion->fecha_hora_payworks }}</b>
    </p>
</div>
@include('emails._pie')
@endsection

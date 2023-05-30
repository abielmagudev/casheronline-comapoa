@extends('aplicacion')
@section('contenido')
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-lg-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <b class="text-uppercase">Autorizar</b>
                    <span>{{ date('d/m/Y') }}</span>
                </div>
            </div>
            <div class="card-body px-4">

                <!-- Cuenta -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Cuenta</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <div class="text-uppercase">
                            <div>{{ $factura->padron->numero_cuenta }}</div>
                            <div>{{ $factura->padron->nombre_completo }}</div>
                            <div>{{ $factura->padron->DOMICILIO }}</div>
                        </div>
                    </div>
                </div>

                <!-- Vencimiento -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Vencimiento</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <div class='text-uppercase'>{{ $factura->vencimiento->fecha(' ', 'nombre') }}</div>
                    </div>
                </div>

                <!-- Desglose -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Desglose</div>
                    </div>
                    <div class="col-sm col-sm-9">
                    @foreach($factura->importe_desglosado as $concepto => $total)
                        @if( $total )
                        <div>
                            <span>${{ number_format($total, 2) }}</span>
                            <small class='text-muted fst-italic'>
                                <span class="mx-1">-</span>
                                {{ ucfirst($concepto) }}
                            </small>
                        </div>
                        @endif
                    @endforeach
                    </div>
                </div>

                @if( $factura->tieneAbonos() )                    
                <!-- Abonado -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Abonado</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <div>${{ $factura->saldoCalculadoConSeparador() }}</div>
                    </div>
                </div>
                @endif

                <!-- Importe -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Importe</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <b>${{ $transaccion->monto_con_separador }}</b>
                    </div>
                </div>

                <!-- Tarjeta bancaria -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">Tarjeta</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <div class="form-control bg-success-subtle is-valid">{{ $transaccion->tarjeta_bancaria->numero_discreto }} {{ strtoupper($transaccion->tarjeta_bancaria->nombre_red) }}</div>
                    </div>
                </div>

                <!-- Código de verificación CVV -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <div class="text-muted">CVV</div>
                    </div>
                    <div class="col-sm col-sm-9">
                        <form action="{{ route('pagar.procesar', [$factura->numero_cuenta, $transaccion->id]) }}" method='post' id='formAutorizarPago' class='mb-1'>
                            <input type="password" id='inputCodigoVerificacion' name='codigo_verificacion' class="form-control" placeholder="Código de verificación (3 ó 4 dígitos)" pattern="{{ $patron_cvv }}" maxlength="4" autofocus required>
                            @csrf
                        </form>
                        <div>
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#encontrarCVVModal">¿Donde encuentro el código de verificación?</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center text-md-end py-3">
                <a href="{{ route('pagar.index') }}" class="btn btn-outline-secondary border-0">Cancelar</a>
                <button class="btn btn-success" type="submit" form="formAutorizarPago" id="buttonAutorizarPago">
                    <span>Autorizar pago</span>
                    <div class="spinner-border spinner-border-sm ms-2 text-white d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>
@include('pagar._modal-cvv')
<script>const buttonAutorizar={element:document.getElementById("buttonAutorizarPago"),keepDisabled:function(){this.element.querySelector(".spinner-border").classList.remove("d-none"),this.element.classList.add("disabled"),this.element.disabled=!0}},formAutorizar={element:document.getElementById("formAutorizarPago"),listen:function(){this.element.addEventListener("submit",()=>buttonAutorizar.keepDisabled())}};formAutorizar.listen();</script>

<?php
/*
const buttonAutorizar = {
    element: document.getElementById('buttonAutorizarPago'),
    keepDisabled: function () {
        this.element.querySelector('.spinner-border').classList.remove('d-none')
        this.element.classList.add('disabled')
        this.element.disabled = true
    }
}
const formAutorizar = {
    element: document.getElementById('formAutorizarPago'),
    listen: function () {
        this.element.addEventListener('submit', () => buttonAutorizar.keepDisabled() )
    }
}
formAutorizar.listen()
*/
?>
@endsection

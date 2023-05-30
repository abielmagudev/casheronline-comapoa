@extends('aplicacion')
@section('contenido')
@include('pagar._mensaje-3ds')
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-lg-6">
        <div class="card shadow">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between">
                    <b class="text-uppercase">Pagar</b>
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
                        <b>${{ $factura->tieneAbonos() ? $factura->importeRestanteConSeparador() : $factura->importeCalculadoConSeparador() }}</b>
                    </div>
                </div>
                
                <!-- Tarjeta bancaria -->
                <div class="row mb-3">
                    <div class="col-sm col-sm-3">
                        <label class="form-label text-nowrap text-muted mt-1" for="selectTarjetasBancarias">Tarjeta</label>
                    </div>
                    <div class="col-sm col-sm-9">
                    @if( $tarjetas_bancarias->isNotEmpty() )
                        <form action="{{ route('pagar.validar', $factura->numero_cuenta) }}" method="post" id="formValidarTarjetaBancaria" class='mb-1'>
                            <select name="tarjeta_bancaria" id="selectTarjetasBancarias" class="form-select" required>
                                <option disabled selected label="Selecciona tarjeta bancaria..."></option>
                                @foreach($tarjetas_bancarias as $tarjeta)
                                <?php if( $tarjeta->tieneInformacionCompleta() ): ?>
                                <option value="{{ $tarjeta->id }}">{{ $tarjeta->numero_discreto }} {{ strtoupper($tarjeta->nombre_red) }}</option>
                                    
                                <?php else: ?>
                                <?php $tarjetas_bancarias_desactualizadas[] = $tarjeta ?>

                                <?php endif ?>
                                @endforeach
                            </select>
                            @csrf
                        </form>
                        <div>
                            <a href="#!" data-bs-toggle="modal" data-bs-target="#validar3DSModal">¿Porqué necesito validar la tarjeta bancaria?</a>
                        </div>

                    @else
                        <div class="alert alert-warning m-0">
                            <div class='mb-1'>Necesitas tener al menos una tarjeta bancaria registrada para continuar.</div>
                            <div class="text-start text-md-end">
                                <a href="{{ route('tarjetas_bancarias.create') }}" class="alert-link">Crear nueva tarjeta bancaria</a>
                            </div>
                        </div> 

                        @isset( $tarjetas_bancarias_desactualizadas )
                        <div class="alert alert-warning mt-2 mb-0">
                            <div class="mb-3">Tienes tarjetas bancarias que necesitan ser actualizadas para usarlas en tus pagos.</div>
                            <div class="text-start text-md-end">
                                <a href="{{ route('tarjetas_bancarias.index') }}" class="alert-link">Ver tarjetas bancarias desactualizadas</a>
                            </div>
                        </div>
                        @endisset

                    @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-center text-md-end py-3">
                <a href="{{ $url_cancelar }}" class="btn btn-outline-secondary border-0">Cancelar</a>

                @if(! $tarjetas_bancarias->isEmpty() )
                <button type="submit" class="btn btn-success" form="formValidarTarjetaBancaria" >Validar tarjeta bancaria</button>
                   
                @else
                <span class="btn btn-secondary disabled">Validar tarjeta bancaria</span>

                @endif
            </div>
        </div>
        <br>
        <br>
        <center>
            <form action="{{ $controladorClabeBanorte->peticion_url }}" method='post'>
                @foreach($controladorClabeBanorte->generarCamposPeticion() as $campo => $valor)
                <input type="hidden" name="{{ $campo }}" value="{{ $valor }}">
                @endforeach
                <button type="submit" class="btn text-white w-100" style='background-color:<?= $controladorClabeBanorte->color ?>'>Pagar con CLABE BANORTE</button>
            </form>
        </center>
    </div>
</div>
@include('pagar._modal-3ds')
@endsection

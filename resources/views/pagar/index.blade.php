@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <div class="d-inline-block float-end">
            <span class='text-uppercase align-middle p-0'>{{ date('d/m/Y') }}</span>
        </div>
        <b class='text-uppercase me-3'>Facturas</b>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Vencimiento</th>
                        <th>Importe</th>
                        <?php /*
                        <th>Saldo</th>
                        <th>Restante</th>
                        */ ?>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class='text-uppercase'>
                    @foreach($facturas as $factura)
                    <tr>
                        <td>{{ $factura->padron->numero_cuenta }}</td>
                        <td class='text-nowrap'>{{ $factura->padron->nombre_completo }}</td>
                        <td>{{ $factura->vencimiento->fecha(' ', 'abreviado') }}</td>
                        <td>${{ $factura->requierePago() ? $factura->importeRestanteConSeparador() : $factura->importeCalculadoConSeparador() }}</td>
                        <?php /*
                        <td>${{ $factura->saldoCalculadoConSeparador() }}</td>
                        <td>${{ $factura->importeRestanteConSeparador() }}</td>
                        */ ?>
                        <td>
                            <span class="badge rounded-pill text-bg-{{ $factura->color_estatus }}">{{ $factura->estatus }}</span>
                        </td>
                        <td class='text-nowrap text-end' style='width:1%'>
                            @if( $factura->requierePago() )        
                            <a href="{{ route('pagar.crear', $factura->numero_cuenta) }}" class="btn btn-outline-primary btn-sm">
                                <span>Pagar</span>
                            </a>

                            @else
                            <span class="btn btn-outline-secondary btn-sm disabled">Pagar</span>

                            @endif                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<x-pagination :collection="$facturas" />
@endsection

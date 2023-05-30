@extends('aplicacion')
@section('contenido')
<div>
    <div class="row justify-content-center justify-content-md-end">
        <div class='col-md col-md-6 col-lg-4'>
            <form action="{{ route('cuentas_asociadas.descargar', $cuenta_asociada->numero) }}" method='get' id='formPeriodoDescarga'>
                <div class="input-group">
                    <span class="input-group-text">Período {{ date('Y') }}</span>
                    <?php /*
                    <select class="form-select" name='anio'>
                        @foreach($periodo['anios'] as $anio)
                        <option value="{{ $anio }}" @selected( request('anio', date('Y)) == $anio )>{{ $anio }}</option>
                        @endforeach
                    </select>
                    */ ?>
                    <select class="form-select refresh-changed" name='mes' autofocus>
                        @foreach($periodo['meses'] as $codigo => $nombre)
                        <option value="{{ $codigo }}" @selected( request('mes', date('m')) == $codigo )>{{ ucfirst($nombre) }}</option>
                        @endforeach
                    </select>
                    <!-- <button class="btn btn-primary" type="submit">Buscar</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
<br>
<div class="card shadow">
    <div class="card-header py-3">
        <b class="text-uppercase me-2">Descargar</b>
        <em class='d-block d-md-inline-block'>{{ $cuenta_asociada->numero }} - {{ $cuenta_asociada->padron->nombre_completo }}</em>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <tbody>
                    @foreach($archivero->conceptos() as $concepto)
                    <tr>
                        <td @class(['py-3', 'border-0' => $loop->last])>{{ $concepto->titulo }}</td>
                        <td @class(['py-3', 'border-0' => $loop->last])>
                            <div class="d-flex justify-content-end">
                                @foreach($concepto->archivos() as $archivo)
                                @if( $archivo->existe() )
                                <div class='mx-1' data-bs-toggle="tooltip" data-bs-title="Disponible">
                                    <a href="{{ $archivo->url }}" download="{{ $archivo->nombre }}" class="btn btn-success btn-sm" target="__blank">
                                        <i class="bi bi-file-earmark"></i>
                                        <span class='text-uppercase'>{{ $archivo->extension }}</span>
                                    </a>
                                </div>
                                    
                                @else
                                <div class='mx-1' data-bs-toggle="tooltip" data-bs-title="No disponible">
                                    <span class="btn btn-outline-secondary btn-sm disabled">
                                        <i class="bi bi-file-earmark"></i>  
                                        <span class='text-uppercase'>{{ $archivo->extension }}</span>
                                    </span>
                                </div>

                                @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<br>
<div class="alert border-0 py-4" style='background-color:#CCC'>
    <h5 class="alert-heading mb-3">No esta disponible el archivo que quiero descargar... ¿qué hago?</h5>
    <p>Si necesitas uno ó varios archivos PDF ó XML que no estan disponibles en esta página, envíanos al correo electrónico <a href="mailto:sistemas@comapanuevolaredo.gob.mx" class='link-primary link-offset-3 text-truncate'>sistemas@comapanuevolaredo.gob.mx</a> la siguiente información:</p>
    <ul class='m-0'>
        <li><em>Número y nombre de la cuenta asociada exáctamente como se muestra en el recibo</em>.</li>
        <li><em>Especifíca el mes(es) y el año(s) correspondientes al archivo(s)</em>.</li>
        <li><em>Tipo(s) de archivo "Complemento de pago", "Recibo domiciliario"</em>.</li>
        <li><em>Formato de archivo(s) (PDF, XML)</em>.</li>
    </ul>
</div>
<br>
<div>
    <p class='small mb-2 mb-md-1'>Para una lectura correcta del recibo en sucursales como OXXO's realiza la impresión en <a target="_blank" href="https://www.kalamazoo.es/portal-informativo/guias/guia-de-compra-tinta-y-toner-diferencias-y-caracteristicas.html">impresoras láser ó tinta</a>.</p>
    <p class='small'>Si no puedes visualizar los archivos PDF, instala y utiliza un lector como <a target="_blank" href="https://www.adobe.com/products/acrobat/readstep2.html">Acrobat Reader</a>.</p>
</div>

<script>const selectorInputsRefreshChanged={elements:document.querySelectorAll(".refresh-changed"),listen:function(){this.elements.forEach(function(e){e.addEventListener("change",()=>document.getElementById("formPeriodoDescarga").submit())})}};selectorInputsRefreshChanged.listen();</script>

<?php /*
<script>
const selectorInputsRefreshChanged = {
    elements: document.querySelectorAll('.refresh-changed'),
    listen: function () {
        this.elements.forEach(function (element) {
            element.addEventListener('change', () => document.getElementById('formPeriodoDescarga').submit())
        })
    }
}
selectorInputsRefreshChanged.listen()
</script>
*/ ?>
@endsection

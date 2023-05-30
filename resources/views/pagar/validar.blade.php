@extends('aplicacion')
@section('contenido')
<div class="row justify-content-center">
    <div class="col-md col-md-10 col-lg-6">
        <div class="alert alert-info">
            <p class='m-0'><b>Desactiva el bloqueador(ADBLOCK) del navegador</b> en caso que el proceso de validación no avance.</p>
        </div>
        <div class="card shadow ">
            <div class="card-header py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <b class="text-uppercase">Validando</b>
                    </div>
                    <div id="loaderProgressIframe3DSecure">
                        <div class="spinner-border spinner-border-sm text-comapa" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 overflow-auto" style="line-height:0;">
                <iframe id='iframe3DSecure' name='iframe3DSecure' frameborder="0" width='100%' height='506px' style='min-width:min-content'></iframe>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('pagar.crear', $numero_cuenta) }}" class="btn btn-danger">Cancelar validación</a>
            </div>
        </div>
    </div>
</div>
<form action="{{ $peticion3DS->obtenerUrl() }}" target="iframe3DSecure" id='formRequest3DSecure' method="post" accept-charset="UTF-8">
    @foreach($peticion3DS->variables() as $variable => $valor)
    <input type="hidden" name="{{ $variable }}" value="{{ $valor }}">
    @endforeach
</form>
<script>const iframe3DSecure={element:document.getElementById("iframe3DSecure"),loader:document.getElementById("loaderProgressIframe3DSecure"),readyStageCounter:0,listen:function(){let e=this;e.element.addEventListener("load",function(){if(e.readyStageCounter<1)return e.readyStageCounter++;setTimeout(function(){e.loader.classList.add("d-none")},5e3)})}};iframe3DSecure.listen();const formRequest3DSecure={element:document.getElementById("formRequest3DSecure"),send:function(){this.element.submit(),this.element.remove()}};formRequest3DSecure.send();</script>

<?php
/*
<script>
const iframe3DSecure = {
    element: document.getElementById('iframe3DSecure'),
    loader: document.getElementById('loaderProgressIframe3DSecure'),
    readyStageCounter: 0,
    listen: function () {
        let self = this
        self.element.addEventListener('load', function () {       
            if( self.readyStageCounter < 1 )
                return self.readyStageCounter++;

            setTimeout(function () {
                self.loader.classList.add('d-none')
            }, 5000)
        })
    }
}
iframe3DSecure.listen()

const formRequest3DSecure = {
    element: document.getElementById('formRequest3DSecure'),
    send: function () {
        this.element.submit()
        this.element.remove()
    }
}
formRequest3DSecure.send()
</script>
*/
?>
@endsection

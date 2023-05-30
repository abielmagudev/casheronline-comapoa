@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <b class="text-uppercase">Cuentas asociadas</b>
                <span class='badge text-bg-primary'>{{ $cuentas_asociadas->count() }}</span>
            </div>
            <div>
                <a href="{{ route('cuentas_asociadas.create') }}" class="btn btn-primary btn-sm">Agregar <span class='d-none d-md-inline'>cuenta asociada</span></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Domicilio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuentas_asociadas as $cuenta_asociada)  
                    <?php $json = json_encode([
                        'url' => route('cuentas_asociadas.destroy', $cuenta_asociada->numero),
                        'info' => sprintf('%s - %s', $cuenta_asociada->numero, $cuenta_asociada->padron->NOMBRE)
                    ]) ?>
                    <tr>
                        <td>{{ $cuenta_asociada->padron->CUENTA }}</td>
                        <td class='text-nowrap text-uppercase'>{{ $cuenta_asociada->padron->NOMBRE }}</td>
                        <td class='text-nowrap text-uppercase'>{{ $cuenta_asociada->padron->DOMICILIO }}</td>
                        <td clasS='text-nowrap text-end align-middle'>
                            <a href="{{ route('cuentas_asociadas.descargar', $cuenta_asociada->numero) }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Descargar">
                                <i class="bi bi-download"></i>
                            </a> 

                            @if( $cuenta_asociada->numero <> auth()->user()->cuenta ) 
                            <div class="d-inline" data-bs-toggle="tooltip" data-bs-title="Remover">
                                <button type="button" class='btn btn-outline-danger btn-sm' data-bs-toggle="modal" data-bs-target="#modalDeleteCuentaAsociada" data-cuenta-asociada='{{ $json }}'>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            @else
                            <div class="d-inline" data-bs-toggle="tooltip" data-bs-title="No es posible eliminar">
                                <span class="btn btn-outline-secondary btn-sm disabled">
                                    <i class="bi bi-trash"></i>
                                </span>
                            </div>

                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeleteCuentaAsociada" tabindex="-1" aria-labelledby="modalDeleteCuentaAsociadaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header border-0">
            <h1 class="modal-title text-muted fs-5" id="modalDeleteCuentaAsociadaLabel"></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h2 class="text-danger text-uppercase">Atención</h2>
            <p clasS='m-0'>¿Deseas remover la siguiente cuenta?</p>
            <p class='fw-bold text-uppercase' id='modalCuentaAsociadaInfo'></p>
            <form action="#!" method="post" id='formDeleteCuentaAsociada'>
                @method('delete')
                @csrf
            </form>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="submit" class="btn btn-outline-danger" form="formDeleteCuentaAsociada">Remover cuenta asociada</button>
            <button type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal">Cancelar</button>
        </div>
    </div>
  </div>
</div>

<!-- Script -->
<script>const modalDeleteCuentaAsociada={modal:document.querySelector("#modalDeleteCuentaAsociada"),data:null,load:function(e){this.modal.querySelector("#formDeleteCuentaAsociada").setAttribute("action",e.url),this.modal.querySelector("#modalCuentaAsociadaInfo").innerText=e.info},listen:function(){let e=this;e.modal.addEventListener("hidden.bs.modal",function(){e.modal.querySelector("#formDeleteCuentaAsociada").setAttribute("action","#!"),e.modal.querySelector("#modalCuentaAsociadaInfo").innerText=""})}};modalDeleteCuentaAsociada.listen();const modalDeleteCuentaAsociadaTriggers={all:()=>document.querySelectorAll("button[data-cuenta-asociada]"),listen:function(){this.all().forEach(function(e){e.addEventListener("click",function(){modalDeleteCuentaAsociada.load(JSON.parse(this.dataset.cuentaAsociada))})})}};modalDeleteCuentaAsociadaTriggers.listen();</script>

<?php
/*
<script>
const modalDeleteCuentaAsociada = {
    modal: document.querySelector('#modalDeleteCuentaAsociada'),
    data: null,
    load: function (data) {
        this.modal.querySelector('#formDeleteCuentaAsociada').setAttribute('action', data.url)
        this.modal.querySelector('#modalCuentaAsociadaInfo').innerText = data.info
    },
    listen: function () {
        let self = this
        self.modal.addEventListener('hidden.bs.modal', function () {
            self.modal.querySelector('#formDeleteCuentaAsociada').setAttribute('action', '#!')
            self.modal.querySelector('#modalCuentaAsociadaInfo').innerText = ''
        })
    }
}
modalDeleteCuentaAsociada.listen()

const modalDeleteCuentaAsociadaTriggers = {
    all: () => document.querySelectorAll('button[data-cuenta-asociada]'),
    listen: function () {
        this.all().forEach( function (trigger) {
            trigger.addEventListener('click', function () {
                modalDeleteCuentaAsociada.load( JSON.parse(this.dataset.cuentaAsociada) )
            })
        })
    }
}
modalDeleteCuentaAsociadaTriggers.listen()
</script>
*/
?>
@endsection

@extends('aplicacion')
@section('contenido')
<div class="card shadow">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <b class="text-uppercase">Tarjetas bancarias</b>
                <span class='badge text-bg-primary'>{{ $tarjetas_bancarias->count() }}</span>
            </div>
            <div>
                <a href="{{ route('tarjetas_bancarias.create') }}" class="btn btn-primary btn-sm">Nueva <span class='d-none d-md-inline'>tarjeta bancaria</span></a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if( $tarjetas_bancarias->count() )
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th></th>
                        <th>Terminación</th>
                        <th>Tipo</th>
                        <th>Red</th>
                        <th>Expira</th>
                        <th>Pagos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarjetas_bancarias as $tarjeta_bancaria)
                    <tr>
                        <td style='width:1%' class='text-center fs-5 px-3'>
                            @if( $tarjeta_bancaria->tieneInformacionCompleta() )
                            <span class='text-success' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Actualizada">
                                <i class="bi bi-check-circle-fill"></i>
                            </span>
                            
                            @else
                            <span class='text-warning' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Desactualizada">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </span>

                            @endif
                        </td>
                        <td class='text-nowrap'>{{ $tarjeta_bancaria->numero_discreto }}</td>
                        <td class='text-nowrap'>{{ ucfirst($tarjeta_bancaria->nombre_tipo) }}</td>
                        <td class='text-nowrap'>{{ ucfirst($tarjeta_bancaria->nombre_red) }}</td>
                        <td class='text-nowrap'>{{ $tarjeta_bancaria->expira }}</td>
                        <td class='text-nowrap'>{{ $tarjeta_bancaria->transacciones_count }}</td>
                        <td class='text-nowrap text-end' style='width:1%'>
                            <a href="{{ route('tarjetas_bancarias.edit', $tarjeta_bancaria->id) }}" class='btn btn-outline-warning btn-sm' data-bs-toggle="tooltip" data-bs-title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            
                            <div class="d-inline" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                <button class='btn btn-outline-danger btn-sm' data-confirm-delete="{{ $tarjeta_bancaria->dataConfirmDeleteModal() }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @else
        <p class="text-center text-muted">Sin tarjetas bancarias...</p>

        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="confirmDeleteModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h2 class="text-danger text-uppercase">Atención</h2>
                <p class='mb-1'>¿Deseas eliminar la siguiente tarjeta bancaria?</p>
                <p class='fw-bold text-uppercase' id='informacionTarjetaBancariaModal'></p>
            </div>
            <div class="modal-footer justify-content-center">
                <form method="post" id="formConfirmDeleteModal">
                    <button type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-danger">Eliminar tarjeta bancaria</button>
                    @csrf
                    @method('delete')
                </form>
            </div>
        </div>
    </div>
</div>
<script>const confirmDeleteModal={element:document.getElementById("confirmDeleteModal"),informacionTarjetaBancaria:document.getElementById("informacionTarjetaBancariaModal"),setInformacionTarjetaBancaria:function(e){let t=[e.tipo,e.numero_discreto,e.red,e.expira,];this.informacionTarjetaBancaria.innerText=t.join(" ")},clearInformacionTarjetaBancaria:function(){this.informacionTarjetaBancaria.innerText=""},listen:function(){this.element.addEventListener("hidden.bs.modal",function(e){confirmDeleteModal.clearInformacionTarjetaBancaria(),confirmDeleteForm.clearAction()})}},confirmDeleteForm={element:document.getElementById("formConfirmDeleteModal"),route:"<?= route('tarjetas_bancarias.destroy', 0) ?>",setAction:function(e){this.element.action=this.route.replace("0",e)},clearAction:function(){this.element.action=""}},confirmDeleteModalTriggers={buttons:document.querySelectorAll("button[data-confirm-delete]"),listen:function(){this.buttons.forEach(function(e){e.addEventListener("click",function(){let e=JSON.parse(this.dataset.confirmDelete);confirmDeleteModal.setInformacionTarjetaBancaria(e),confirmDeleteForm.setAction(e.id)})})}};confirmDeleteModalTriggers.listen(),confirmDeleteModal.listen();</script>

<?php
/*
<script>
const confirmDeleteModal = {
    element: document.getElementById('confirmDeleteModal'),
    informacionTarjetaBancaria: document.getElementById('informacionTarjetaBancariaModal'),
    setInformacionTarjetaBancaria: function (tarjeta_bancaria) {
        let informacion = [
            tarjeta_bancaria.tipo,
            tarjeta_bancaria.numero_discreto,
            tarjeta_bancaria.red,
            tarjeta_bancaria.expira,
        ]
        this.informacionTarjetaBancaria.innerText = informacion.join(' ')
    },
    clearInformacionTarjetaBancaria: function () {
        this.informacionTarjetaBancaria.innerText = ''
    },
    listen: function () {
        this.element.addEventListener('hidden.bs.modal', function (event) {
            confirmDeleteModal.clearInformacionTarjetaBancaria()
            confirmDeleteForm.clearAction()
        })
    }
}

const confirmDeleteForm = {
    element: document.getElementById('formConfirmDeleteModal'),
    route: "<?= route('tarjetas_bancarias.destroy', 0) ?>",
    setAction: function (id) { 
        this.element.action = this.route.replace('0', id)
    },
    clearAction: function () {
        this.element.action = ''
    }
}

const confirmDeleteModalTriggers = {
    buttons: document.querySelectorAll('button[data-confirm-delete]'),
    listen: function () {
        this.buttons.forEach( function (button) {
            button.addEventListener('click', function () {
                let tarjeta_bancaria = JSON.parse(this.dataset.confirmDelete);
                confirmDeleteModal.setInformacionTarjetaBancaria(tarjeta_bancaria)
                confirmDeleteForm.setAction(tarjeta_bancaria.id)
            })
        })
    }
}
confirmDeleteModalTriggers.listen()
confirmDeleteModal.listen()
</script>
*/
?>
@endsection

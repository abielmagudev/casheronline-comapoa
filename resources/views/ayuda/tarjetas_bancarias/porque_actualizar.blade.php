<?php $collapse_id = "collapsePorqueActualizarTarjetaBancaria" ?>
<div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingNoVerificaNoAutorizaTarjetaBancaria">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Porque me pide que actualice mis tarjetas bancarias?</span>
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>La información requerida de tus tarjetas bancarias para realizar pagos a través de la web, son solicitados por el proveedor del sistema bancario digítal, <b>no son solicitados por nuestra institución</b>.</p>
            <p>La implementación de nuevas actualizaciones aumenta la confiabilidad, facilidad y seguridad de las transacciones entre el banco emisor de la tarjeta bancaria y el usuario por medio de nuestra plataforma.</p>
            <p><b class='text-uppercase'>Importante</b>. Leer y entender los <a href="#!" data-bs-toggle="modal" data-bs-target="#terminosCondicionesModal">términos y condiciones</a> para el uso correcto y seguro.</p>
        </div>
    </div>
</div>

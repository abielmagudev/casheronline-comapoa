<?php $collapse_id = "collapseNoVerificaNoAutorizaTarjetaBancaria" ?>
<div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingNoVerificaNoAutorizaTarjetaBancaria">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Porque no se verifica ó autoriza la tarjeta bancaria?</span>
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>Posibles situaciones por las que no se valida ó no se autoriza el pago con tus tarjetas bancarias:</p>
            <ul>
                <li>El bloqueador (ADBLOCK) del navegador no permite el avance del proceso de validación ó autorización.</li>
                <li>No se ha actualizado ó la información actualizada no es correcta.</li>
                <li>El código de validación no se ingreso ó es incorrecto.</li>
                <li>La tarjeta bancaria tiene algún impedimento ó bloqueo por el banco emisor.</li>
                <li>La autorización fue denegada por la información desactualizada, por el codigo de verificación u otro factor como la conexión a internet.</li>
            </ul>
            <p><b>Sugerencia:</b> Actualizá cuidadosamente la información según la solicitud del formulario ó elimina la tarjeta bancaria, guarda de nuevo la tarjeta bancaria e intenta hacer el pago en línea nuevamente.</p>
            <p>Si algúna situación u otra parecida a estas, revisaló con tu banco emisor para confirmar la información y disponibilidad de la tarjeta bancaria sea correcta.</p>
        </div>
    </div>
</div>

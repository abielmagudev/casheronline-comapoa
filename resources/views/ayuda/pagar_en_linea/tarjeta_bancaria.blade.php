<?php $collapse_id = "collapseTarjetaBancariaPagar" ?>
<div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingTarjetaBancariaPagar">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Que necesito para hacer pagos en línea?</span>
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>Para realizar pagos en línea se requiere:</p>
            <ul>
                <li><b>Tarjeta bancaria.</b> Tener al menos una tarjeta bancaria registrada y actualizada. Estas deben estar vigentes y válidadas por el formulario.</li>
                <li><b>Dispositivo móvil.</b> Obtener los códigos de validación a través de la aplicación bancaria, mensajes de texto(SMS) ó medio disponible para estos.</li>
                <li><b>Correo electrónico.</b> (Opcional) Donde pueda recibir notificaciones de sus transacciones éxistosas registradas en nuestra plataforma. Este requisito es opcional, ya que es recomendable como prioridad usar la aplicación de su banco emisor para ver los movimientos realizados.</li>
            </ul>
            <p>Para tener transacciones(pagos) éxitosos, el proceso tiene 2 etapas:</p>
            <ol>
                <li>La actualización de las tarjetas bancarias registradas y las validaciónes de 3D Secure.</li>
                <li>La autorizacion de pagos a través de los códigos de verificación de las tarjetas bancarias.</li>
            </ol>
            <p><b class='text-uppercase'>Importante</b>. Leer y entender los <a href="#!" data-bs-toggle="modal" data-bs-target="#terminosCondicionesModal">términos y condiciones</a> para el uso correcto y seguro.</p>
        </div>
    </div>
</div>

<?php $collapse_id = "collapseBanortePagar" ?>
<div class="accordion-item">
    <h2 class="accordion-header" id="headingBanortePagar">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Hay otra forma de pago en línea?</span>
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>Si lo hay. Puedes realizar tus pagos a través del portal de BANORTE, solo requieres tu número de cuenta CLABE y una identificación como IFE o número de pasaporte.</p>
            <p>En esta opción, los requisitos pueden cambiar, ya que el pago como la información que se requiere para la transacción depende totalmente de la plataforma de BANORTE.</p>
        </div>
    </div>
</div>

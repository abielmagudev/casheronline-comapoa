<?php $collapse_id = "collapseCuentaOcupada" ?>
<div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingCuentaOcupada">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Porque no me permite agregar una cuenta asociada?</span>    
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>Posibles situaciones por las que no puedes agregar una cuenta asociada:</p>
            <ul>
                <li>El número y nombre de la cuenta no corresponden entre sí correctamente.</li>
                <li>El nombre de cuenta contiene caractéres especiales como acentos, tildes u otros símbolos.</li>
                <li>El número de cuenta está asociada con otro usuario.</li>
            </ul>
            <p>Si algúna de estas situaciones ocurre, envíanos un correo electrónico con una explicación de lo sucedido a <span class='text-primary'>sistemas@comapanuevolaredo.gob.mx</span>.</p>
        </div>
    </div>
</div>

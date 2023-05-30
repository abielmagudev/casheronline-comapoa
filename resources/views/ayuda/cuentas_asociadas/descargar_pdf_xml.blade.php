<?php $collapse_id = "collapseDescargarPdfXml" ?>
<div class="accordion-item border-0">
    <h2 class="accordion-header" id="headingDescargarPdfXml">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $collapse_id }}" aria-expanded="false" aria-controls="{{ $collapse_id }}">
            <span class="lh-base">¿Dónde puedo descargar archivos PDF ó XML de una cuenta asociada?</span>    
        </button>
    </h2>
    <div id="{{ $collapse_id }}" class="accordion-collapse collapse bg-primary bg-opacity-10" data-bs-parent="#{{ $parent_accordion }}">
        <div class="accordion-body">
            <p>Una vez autenticado en nuestra plataforma, realiza los siguientes pasos:</p>
            <ul>
                <li>En la barra superior, haz clic en la opción "Cuentas asociadas".</li>
                <li>Una vez mostrada la lista, posiciona sobre la cuenta asociada y haz clic en el botón azul con el ícono "Descargar".</li>
                <li>En la sección de descarga, haz clic en el boton verde que marca el archivo PDF o XML disponible.</li>
                <li>Puedes seleccionar otro mes del año presente para descargar archivos, si estos estan disponibles.</li>
            </ul>
            <p>Si requieres algún archivo(s) de otro año ó no disponible, envíanos un correo electrónico a <span class='text-primary'>sistemas@comapanuevolaredo.gob.mx</span> con la siguiente información:</p>
            <ul>
                <li>Número y nombre de la(s) cuenta asociada seleccionada.</li>
                <li>Especifíca el tiempo con el mes y el año de la solicitud.</li>
                <li>El tipo de archivo "Complemento de pago" ó "Recibo domiciliario".</li>
                <li>El formato del archivo PDF ó XML.</li>
            </ul>
            <p>Te enviaremos un correo electrónico con el resultado ó respuesta a la solicitud recibida.</p>
        </div>
    </div>
</div>

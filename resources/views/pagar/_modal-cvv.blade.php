<!-- Modal -->
<div class="modal fade" id="encontrarCVVModal" tabindex="-1" aria-labelledby="encontrarCVVModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="encontrarCVVModalLabel">¿Donde encuentro el código de verificación?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('imagenes/cvv-tarjeta.png') }}" class="img-fluid rounded" alt="CVV">
                </div>
                <p>Regularmente el código de verificación(<em>CVV</em>) se encuentran al reverso de la tarjeta bancaria, este puede contener 3 ó 4 dígitos númericos.</p>
                <p>Sin embargo, en algúnas tarjetas bancarias es posible que se muestre en la parte frontal.</p>
                <p>
                    <b>Asegúrate que el código de verificación sea de la tarjeta bancaria que se verificó para pagar.</b>
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary " data-bs-dismiss="modal">Entendido</button>
            </div>
        </div>
    </div>
</div>

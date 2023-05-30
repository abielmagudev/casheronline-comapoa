<!-- Contraseña -->
<div class="tab-pane fade p-3" id="contrasena-tab-pane" role="tabpanel" aria-labelledby="contrasena-tab" tabindex="0">
    <form action="{{ route('usuario.update.contrasena') }}" method='post' autocomplete="off">
        <div class="mb-3">
            <label for="inputContrasenaActual" class="form-label">Contraseña actual</label>
            <input type="password" class="form-control @error('contrasena_actual') is-invalid @enderror" id="inputContrasenaActual" name='contrasena_actual' required>
            <x-error name='contrasena_actual' />
        </div>
        <div class="mb-3">
            <label for="inputNuevaContrasena" class="form-label">Nueva contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control @error('nueva_contrasena') is-invalid @enderror" id="inputNuevaContrasena" name='nueva_contrasena' required>
                <button class="btn btn-outline-secondary revelador" data-secreto='inputNuevaContrasena' type="button">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <x-error name='nueva_contrasena' />
        </div>
        <div class="mb-3">
            <label for="inputConfirmarNuevaContrasena" class="form-label">Confirmar nueva contraseña</label>
            <div class="input-group">
                <input type="password" class="form-control @error('confirmar_nueva_contrasena') is-invalid @enderror" id="inputConfirmarNuevaContrasena" name='confirmar_nueva_contrasena' required>
                <button class="btn btn-outline-secondary revelador" data-secreto="inputConfirmarNuevaContrasena" type="button">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <x-error name='confirmar_nueva_contrasena' />
        </div>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Actualizar contraseña</button>
        </div>
        @method('patch')
        @csrf
    </form>
</div>
<x-script-reveal-secret-click />

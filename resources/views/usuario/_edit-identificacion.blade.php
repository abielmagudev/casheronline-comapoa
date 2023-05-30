<!-- Identificación -->
<div class="tab-pane fade show p-3 active" id="identificación-tab-pane" role="tabpanel" aria-labelledby="identificación-tab" tabindex="0">
    <form action="{{ route('usuario.update.identificacion') }}" method='post' autocomplete="off">
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Nombre personal o compañia</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="inputNombre" name='nombre' value="{{ auth()->user()->nombre_completo }}" required>
            <x-error name='nombre'>
                <small id="inputNombreAyuda" class="form-text">Solo letras, números y espacios</small>
            </x-error>
        </div>
        <div class="mb-3">
            <label for="inputCorreoElectronico" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" id="inputCorreoElectronico" name='correo_electronico' value="{{ auth()->user()->correo_electronico }}" required>
            <x-error name='correo_electronico'>
                <small id="emailCorreoElectronicoAyuda" class="form-text">Para recibir notificaciones de la plataforma</small>
            </x-error>
        </div>
        <div class="mb-3">
            <label for="inputUsuario" class="form-label">Usuario</label>
            <input type="text" class="form-control @error('usuario') is-invalid @enderror" id="inputUsuario" name='usuario' value="{{ auth()->user()->nombre_usuario }}" required>
            <x-error name='usuario'>
                <small id="inputUsuarioAyuda" class="form-text">De 6 a 12 caractéres (Guion bajo, letra ó númerico)</small>
            </x-error>
        </div>
        <div class="text-end">
            <button class="btn btn-success" type="submit">Actualizar usuario</button>
        </div>
        @method('patch')
        @csrf
    </form>
</div>

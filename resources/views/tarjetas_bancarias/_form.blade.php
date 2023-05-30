<div class="mb-3">
    <label for="inputNumero" class="form-label">Número</label>
    <input type="text" class="form-control @error('numero') is-invalid @enderror" id="inputNumero" placeholder="{{ $tarjeta_bancaria->numero_discreto ?? 'Exáctamente 16 dígitos' }}" name="numero" value="{{ old('numero') }}" maxlength="16" pattern="{{ $patterns['numero_tarjeta_bancaria'] }}" {{ is_null(old('numero', $tarjeta_bancaria->id)) ? 'autofocus' : '' }} {{ is_null(old('numero', $tarjeta_bancaria->id)) ? 'required' : '' }}>
    <x-error name='numero' />
</div>
<div class="mb-3">
    <label for="selectMes" class="form-label">Expira</label>
    <div class="row">
        <div class="col">
            <select class="form-select @error('mes') is-invalid @enderror" id='selectMes' name='mes' required>
                <option disabled selected label='Mes...'></option>
                @foreach($meses as $mes)
                <option value="{{ $mes }}" @selected( $mes == old('mes', $tarjeta_bancaria->expira_mes) ) >{{ $mes }}</option>
                @endforeach
            </select>
            <x-error name='mes' />
        </div>
        <div class="col">
            <select class="form-select @error('anio') is-invalid @enderror" id='selectAnio' name='anio' required>
                <option disabled selected label='Año...'></option>
                @foreach($anios as $anio)
                <option value="{{ $anio }}" @selected( $anio == old('anio', $tarjeta_bancaria->expira_anio) )>20{{ $anio }}</option>
                @endforeach
            </select>
            <x-error name='anio' />
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="selectTipo" class="form-label">Tipo</label>
    <select class="form-select text-capitalize @error('tipo') is-invalid @enderror" id="selectTipo" name="tipo" required>
        @foreach($tipos as $clave => $nombre)
        <option value="{{ $clave }}" @selected( $clave == old('tipo', $tarjeta_bancaria->clave_tipo) )>{{ $nombre }}</option>
        @endforeach
    </select>
    <x-error name='tipo' />
</div>
<div class="mb-3">
    <label for="selectRed" class="form-label">Red</label>
    <select class="form-select text-capitalize @error('red') is-invalid @enderror" id="selectRed" name="red" required>
        @foreach($redes as $clave => $nombre)
        <option value="{{ $clave }}" @selected( $clave == old('red', $tarjeta_bancaria->clave_red) )>{{ $nombre }}</option>
        @endforeach
    </select>
    <x-error name='red' />
</div>
<div class="mb-3">
    <label for="inputNombre" class="form-label">Nombre</label>
    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="inputNombre" name="nombre" value="{{ old('nombre', $tarjeta_bancaria->info('nombre')) }}" pattern="{{ $patterns['letras_espacios'] }}" required>
    <x-error name='nombre' />
</div>
<div class="mb-3">
    <label for="inputApellido" class="form-label">Apellido</label>
    <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="inputApellido" name="apellido" value="{{ old('apellido', $tarjeta_bancaria->info('apellido')) }}" pattern="{{ $patterns['letras_espacios'] }}" required>
    <x-error name='apellido'/>
</div>
<div class="mb-3">
    <label for="inputCalle" class="form-label">Calle y número</label>
    <input type="text" class="form-control @error('calle') is-invalid @enderror" id="inputCalle" name="calle" value="{{ old('calle', $tarjeta_bancaria->info('calle')) }}" pattern="{{ $patterns['letras_numeros_espacios'] }}" required>
    <x-error name='calle' />
</div>
<div class="mb-3">
    <label for="inputCodigoPostal" class="form-label">Código postal</label>
    <input type="text" class="form-control @error('codigo_postal') is-invalid @enderror" id="inputCodigoPostal" name="codigo_postal" value="{{ old('codigo_postal', $tarjeta_bancaria->info('codigo_postal')) }}" pattern="{{ $patterns['numeros'] }}" required>
    <x-error name='codigo_postal' />
</div>
<div class="mb-3">
    <label for="selectPais" class="form-label">Pais</label>
    <select class="form-select @error('pais') is-invalid @enderror" id="selectPais" name="pais" required>
        <option disabled selected label='Selecciona pais...'></option>
        @foreach($paises as $codigo => $pais)
        <option value="{{ $codigo }}" @selected( $codigo == old('pais', $tarjeta_bancaria->info('pais')) )>{{ $pais['nombre'] }}</option>
            
        @endforeach
    </select>
    <x-error name='pais' />
</div>
<div class="mb-3">
    <label for="selectEstado" class="form-label">Estado</label>
    <select class="form-select @error('estado') is-invalid @enderror" id="selectEstado" name="estado" required>
        <option disabled selected label="{{ old('pais') ? 'Ahora selecciona el estado...' : 'Primero selecciona el pais...' }}"></option>
        @foreach($paises as $codigo_pais => $pais)
        <optgroup id="optgroup{{ $codigo_pais }}" label="{{ $pais['nombre'] }}" class="{{ $codigo_pais <> old('pais', $tarjeta_bancaria->info('pais')) ? 'd-none' : '' }}">
            
        @foreach($pais['estados'] as $codigo_estado => $nombre_estado)
            <option value="{{ $codigo_estado }}" 
                @selected( 
                    $codigo_pais   == old('pais', $tarjeta_bancaria->info('pais')) &&
                    $codigo_estado == old('estado', $tarjeta_bancaria->info('estado')) 
                )>{{ $nombre_estado }}</option>

            @endforeach

        </optgroup>
        @endforeach
    </select>
    <x-error name='estado' />
</div>
<div class="mb-3">
    <label for="inputCiudad" class="form-label">Ciudad</label>
    <input type="text" class="form-control  @error('ciudad') is-invalid @enderror" id="inputCiudad" name="ciudad" value="{{ old('ciudad', $tarjeta_bancaria->info('ciudad')) }}" pattern="{{ $patterns['letras_espacios'] }}" required>
    <x-error name='ciudad' />
</div>
<div class="mb-3">
    <label for="inputNumeroCelular" class="form-label">Número de celular</label>
    <input type="text" class="form-control  @error('numero_celular') is-invalid @enderror" id="inputNumeroCelular" placeholder="Solamente números" name="numero_celular" value="{{ old('numero_celular', $tarjeta_bancaria->info('numero_celular')) }}" pattern="{{ $patterns['numeros'] }}" required>
    <x-error name='numero_celular' />
</div>
<div class="mb-3">
    <label for="inputCorreo" class="form-label">Correo electrónico</label>
    <input type="email" class="form-control @error('correo') is-invalid @enderror" id="inputCorreo" name="correo" value="{{ old('correo', $tarjeta_bancaria->info('correo')) }}" required>
    <x-error name='correo' />

    <div class="form-check mt-1">
        <input class="form-check-input" type="checkbox" id="checkboxCopia" name='copia' value='1' <?= is_null($tarjeta_bancaria->id) ? 'checked' : ( old('copia', $tarjeta_bancaria->copia_correo) ? 'checked' : '' ) ?>>
        <label class="form-check-label small" for="checkboxCopia">Enviar una copia de la transacción efectuada a este correo electrónico</label>
    </div>
    <x-error name='copia' />
</div>
<br>

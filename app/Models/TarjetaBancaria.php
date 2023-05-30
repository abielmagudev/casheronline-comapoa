<?php

namespace App\Models;

use App\Models\Features\AyudasTabla;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use stdClass;

class TarjetaBancaria extends Model
{
    use AyudasTabla;

    const CLAVES_NOMBRES_TIPO = [
		'DB' => 'débito',
		'CR' => 'crédito',
	];
	
	const CLAVES_NOMBRES_RED = [
		1 => 'visa',
		2 => 'mastercard'
	];

    const CAMPOS_INFORMACION = [
		'NOMBRE',
		'APELLIDO',
		'CALLE',
		'CODIGO_POSTAL',
		'CIUDAD',
		'ESTADO',
		'PAIS',
		'NUMERO_CELULAR',
		'CORREO',
	];

    protected $table = 'tarbancand';

    public $informacion_cache = null;


    // Attributes

    public function getIdUsuarioAttribute()
    {
        return $this->id_web;
    }

    public function getClaveTipoAttribute()
    {
        return $this->tipo_tarjeta;
    }

    public function getNombreTipoAttribute()
    {
        return self::CLAVES_NOMBRES_TIPO[ $this->clave_tipo ] ?? null;
    }

    public function getClaveRedAttribute()
    {
        return $this->ttipotarj;
    }
    
    public function getNombreRedAttribute()
    {
        return self::CLAVES_NOMBRES_RED[ $this->clave_red ] ?? null;
    }

    public function getExpiraAttribute()
    {
        return $this->tvenc;
    }

    public function getExpiraSinSeparadorAttribute()
    {
        return str_replace('/', '', $this->expira);
    }

    public function getExpiraMesAttribute()
    {
        $exploded = explode('/', $this->expira);
        return array_shift( $exploded );
    }

    public function getExpiraAnioAttribute()
    {
        $exploded = explode('/', $this->expira);
        return array_pop( $exploded );
    }

    public function getNumeroAttribute()
    {
        return $this->decodificada ?? null;
    }

    public function getUltimosCuatroDigitosAttribute()
    {
        return substr($this->decodificada, '-4') ?? null;
    }

    public function getNumeroDiscretoAttribute()
    {
        return $this->numero ? "**** {$this->ultimos_cuatro_digitos}" : null;
    }

    /**
     * If has error when convert string to json(object), return a standard class oh PHP
     * json_last_error() <> JSON_ERROR_NONE 
     */
    public function getInformacionJsonAttribute()
    {
        return json_decode($this->informacion) ?? new stdClass;
    }

    public function getInformacionArrayAttribute()
    {
        return json_decode($this->informacion, true) ?? [];
    }

    public function extraerUltimosDigitos(int $limite)
    {
        return substr($this->numero, -$limite);
    }

    public function info(string $propiedad)
    {
        if( is_null($this->informacion_cache) )
            $this->informacion_cache = $this->informacion_array;

        return array_key_exists($propiedad, $this->informacion_cache) ? $this->informacion_cache[$propiedad] : '';
    }

    public function dataConfirmDeleteModal()
    {
        return json_encode([
            'numero_discreto' => $this->numero_discreto ?? '',
            'id' => $this->id,
            'expira' => $this->expira ?? '',
            'red' => $this->nombre_red ?? '',
            'tipo' => $this->nombre_tipo ?? '',
        ]);
    }


    // Relationships

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'id_tarjeta', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id', 'id_web');
    }

    
    // Validators

    public function tieneInformacionCompleta()
    {
        return count( array_filter($this->informacion_array) ) == count(self::CAMPOS_INFORMACION);
    }

    public function enviarCopiaTransaccion()
    {
        return (bool) $this->copia_correo;
    }


    // Scopes

    public function scopeWhereUsuario($query, $id_usuario)
    {
        return $query->where('id_web', $id_usuario);
    }

    public function scopeWherePropietario($query, $id, $id_usuario)
    {
        return $query->where('id', $id)->where('id_web', $id_usuario);
    }

    public function scopeActualizadas($query)
    {
        return $query->whereNotNull('informacion');
    }

    public function scopeDecodificadas($query)
    {
        $segmento_decodificar_numero_sql = self::segmentoDecodificarNumeroSQL();
        return $query->selectRaw("*, {$segmento_decodificar_numero_sql}");
    }

    public function scopeDecodificada($query, $valor, string $columna = 'id')
    {
        $segmento_decodificar_numero_sql = self::segmentoDecodificarNumeroSQL();
        return $query->selectRaw("*, {$segmento_decodificar_numero_sql}")->where($columna, $valor);
    }


    // Statics

    public static function segmentoDecodificarNumeroSQL()
    {
        return sprintf("DECODE(tnumero, CONCAT(trandomnum, '%s')) AS decodificada", 
            config('aplicacion.saleros.tarjeta_bancaria.numero')
        );
    }

    public static function segmentoCodificarNumeroSQL(string $numero, $numero_aleatorio = null)
    {
        return sprintf("ENCODE('%s', CONCAT(%s, '%s'))", 
            $numero, 
            is_numeric($numero_aleatorio) ? "'{$numero_aleatorio}'" : 'trandomnum', 
            config('aplicacion.saleros.tarjeta_bancaria.numero')
        );
    }

    public static function obtenerRangoMeses(string $concatenar = null)
    {
        $rango_meses = array_map(function ($numero) {
            return str_pad($numero, 2, 0, STR_PAD_LEFT);
        }, range(1,12));

        return ! is_null($concatenar) ? implode($concatenar, $rango_meses) : $rango_meses;
    }
    
    public static function obtenerRangoAnios(string $concatenar = null)
    {
        $rango_max = date('y') + 7;
        $rango_min = date('y') - 7;
        $rango_anios = range($rango_max, $rango_min);

        return ! empty($concatenar) ? implode($concatenar, $rango_anios) : $rango_anios;
    }

    public static function obtenerClavesTipo(string $concatenar = null)
    {
        return ! empty($concatenar) ? implode($concatenar, array_keys(self::CLAVES_NOMBRES_TIPO)) : array_keys(self::CLAVES_NOMBRES_TIPO); 
    }

    public static function obtenerClavesRed(string $concatenar = null)
    {
        return ! empty($concatenar) ? implode($concatenar, array_keys(self::CLAVES_NOMBRES_RED)) : array_keys(self::CLAVES_NOMBRES_RED); 
    }


    // Store

    public static function prepararParaGuardar(array $validated)
    {
        $numero_aleatorio = mt_rand(100000, 999999);

        $segmento_codificar_numero_sql = self::segmentoCodificarNumeroSQL($validated['numero'], $numero_aleatorio);

        return [
            'id_web' => auth()->user()->id,
            'tnumero' => DB::raw( $segmento_codificar_numero_sql ),
            'ttipotarj' => $validated['red'],
            'tvenc' => sprintf('%s/%s', $validated['mes'], $validated['anio']),
            'trandomnum' => $numero_aleatorio,
            'tipo_tarjeta' => $validated['tipo'],
            'informacion' => json_encode([
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'calle' => $validated['calle'],
                'codigo_postal' => $validated['codigo_postal'],
                'pais' => $validated['pais'],
                'estado' => $validated['estado'],
                'ciudad' => $validated['ciudad'],
                'numero_celular' => $validated['numero_celular'],
                'correo' => $validated['correo'],
            ]),
            'copia_correo' => (int) isset($validated['copia']),
        ];
    }

    public static function guardar(array $validated)
    {
        try {
            $preparados = self::prepararParaGuardar($validated);
            $nueva_tarjeta_bancaria_id = DB::table( self::obtenerNombreTabla() )->insertGetId( $preparados );
            return self::decodificada($nueva_tarjeta_bancaria_id)->first();

        } catch (Exception $e) {
            return false;
        }
    }


    // Update

    public static function prepararParaActualizar(array $validated)
    {
        $preparados = [
            'ttipotarj' => $validated['red'],
            'tvenc' => sprintf('%s/%s', $validated['mes'], $validated['anio']),
            'tipo_tarjeta' => $validated['tipo'],
            'informacion' => json_encode([
                'nombre' => $validated['nombre'],
                'apellido' => $validated['apellido'],
                'calle' => $validated['calle'],
                'codigo_postal' => $validated['codigo_postal'],
                'pais' => $validated['pais'],
                'estado' => $validated['estado'],
                'ciudad' => $validated['ciudad'],
                'numero_celular' => $validated['numero_celular'],
                'correo' => $validated['correo'],
            ]),
            'copia_correo' => (int) isset($validated['copia']),
        ];

        if( isset($validated['numero']) )
        {
            $segmento_codificar_numero_sql = self::segmentoCodificarNumeroSQL($validated['numero']);
            $preparados['tnumero'] = DB::raw( $segmento_codificar_numero_sql );
        }

        return $preparados;
    }

    public static function actualizar(array $validated, $id)
    {
        try {
            $preparados = self::prepararParaActualizar($validated);
            return DB::table( self::obtenerNombreTabla() )->where('id', $id)->limit(1)->update($preparados);
        
        } catch (Exception $e) {
            return false;
        } 
    }
}

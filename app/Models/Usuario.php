<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Model;

use App\Models\Features\AyudasTabla;
use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use AyudasTabla;
    use HasApiTokens;
    use Notifiable;

    protected $fillable = [
        'usuario',
        'password',
        'nombre',
        'email',
        'cuenta',
        'acepto_terminos_condiciones',
    ];

    protected $table = 'usuarios';

    public $timestamps = false;


    // Attributes

    public function getNombreUsuarioAttribute()
    {
        return $this->usuario;
    }

    public function getNombreCompletoAttribute()
    {
        if( is_null($this->nombre) )
            return sprintf('%s %s %s', $this->nombres, $this->apellidopaterno, $this->apellidomaterno);
        
        return $this->nombre;
    }

    public function getNumeroCuentaPrincipalAttribute()
    {
        return $this->cuenta;
    }

    public function getCorreoElectronicoAttribute()
    {
        return $this->email;
    }
    
    public function getNombreDiscretoCorreoElectronicoAttribute()
    {
        if(! $this->tieneCorreoElectronico() )
            return '';

        list($nombre, $dominio) = explode('@', $this->email);
        $caracteres_discretos = str_repeat('*', (strlen($nombre) - 1));
        $ultimo_caracter = substr($nombre, -1);

        return sprintf('%s%s@%s', $caracteres_discretos, $ultimo_caracter, $dominio);
    }


    // Relationships

    public function cuenta_principal()
    {
        return $this->hasOne(Padron::class, 'CUENTA', 'cuenta');
    }

    public function cuentas_asociadas()
    {
        return $this->hasMany(CuentaAsociada::class, 'id_usuario', 'id');
    }


    // Validators

    public function tieneCorreoElectronico()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }
    
    public function tieneAceptadoTerminosCondiciones()
    {
        return is_string($this->acepto_terminos_condiciones) &&! empty($this->acepto_terminos_condiciones);
    }


    // Scopes

    public function scopeContrasenaDecodificada($query)
    {
        $segmento_decodificar_contrasena = self::obtenerSegmentoDecodificarContrasena();
        return $query->selectRaw("*, {$segmento_decodificar_contrasena}");
    }

    public function scopeDecodificado($query, $valor, string $columna = 'id')
    {
        return $query->where($columna, $valor)->contrasenaDecodificada();
    }


    // Static

    public static function obtenerSegmentoCodificarContrasena(string $contrasena)
    {
        return sprintf('ENCODE("%s", "%s")', $contrasena, config('aplicacion.saleros.usuario.contrasena'));
    }

    public static function obtenerSegmentoDecodificarContrasena()
    {
        return sprintf('DECODE(password, "%s") as contrasena_decodificada', config('aplicacion.saleros.usuario.contrasena'));
    }

    
    // Store

    public static function prepararParaGuardar(array $validated)
    {
        $segmento_codificar_contrasena = self::obtenerSegmentoCodificarContrasena($validated['confirmar_contrasena']);

        return [
            'usuario' => $validated['usuario'],
            'password' => DB::raw( $segmento_codificar_contrasena ),
            'nombre' => $validated['nombre'],
            'email' => $validated['correo_electronico'],
            'cuenta' => $validated['numero_cuenta'],
            'acepto_terminos_condiciones' => now()->toDateTimeString(),
        ];
    }

    public static function guardarRetornaId(array $validated)
    {
        return DB::table( self::obtenerNombreTabla() )->insertGetId(
            self::prepararParaGuardar($validated)
        );
    }

    public static function guardar(array $validated)
    {
        try {
            $id_nuevo_usuario = self::guardarRetornaId($validated);
            $usuario = self::decodificado($id_nuevo_usuario)->first();

            CuentaAsociada::guardarRelacionDirecta($usuario->numero_cuenta_principal, $usuario->id);

            return $usuario;

        } catch (Exception $e) {
            return false;

        }
    }


    // Update

    public static function prepararParaActualizarIdentificacion(array $validated)
    {
        return [
            'email' => $validated['correo_electronico'],
            'nombre' => $validated['nombre'],
            'usuario' => $validated['usuario'],
        ];
    }

    public static function prepararParaActualizarContrasena(array $validated)
    {
        $segmento_codificar_contrasena = self::obtenerSegmentoCodificarContrasena($validated['confirmar_nueva_contrasena']);

        return [
            'password' => DB::raw( $segmento_codificar_contrasena ),
        ];
    }

    public static function actualizar(array $preparados)
    {
        return is_int( self::where('id', Auth::id())->limit('1')->update($preparados) );
    }


    // Generate temporary passwords

    public static function prepararParaGenerarContrasenaTemporal()
    {
        $segmento_codificar_contrasena = self::obtenerSegmentoCodificarContrasena( Str::random(12) );

        return [
            'password' => DB::raw( $segmento_codificar_contrasena ),
        ];
    }

    public static function generarContrasenaTemporal($columna, $valor)
    {
        $preparados = self::prepararParaGenerarContrasenaTemporal();
        return is_int( self::where($columna, $valor)->limit('1')->update($preparados) );
    }

    public static function generarContrasenaTemporalPorNumeroCuenta(string $numero_cuenta)
    {
        return self::generarContrasenaTemporal('cuenta', $numero_cuenta);
    }

    public static function generarContrasenaTemporalPorCorreoElectronico(string $correo_electronico)
    {
        return self::generarContrasenaTemporal('email', $correo_electronico);
    }
}

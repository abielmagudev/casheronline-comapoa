<?php

namespace App\Models;

use App\Models\Factura\CalcularSaldoInterface;
use App\Models\Transaccion\PayworksTrait;
use App\Outsourcing\Banorte\Payworks\PeticionPWS;
use App\Outsourcing\Banorte\Payworks\RespuestaPWS;
use App\Outsourcing\Banorte\ThreeDSecure\Peticion3DS;
use App\Outsourcing\Banorte\ThreeDSecure\Respuesta3DS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaccion extends Model implements CalcularSaldoInterface
{
    use PayworksTrait;

    protected $table = 'transaccionese';

    protected $fillable = [
        'borrado',
        'cavv',
        'codigo_payw_rechazo',
        'codigoautpay',
        'cuenta',
        'eci',
        'expira',
        'fecha_hora_3dsecure',
        'fecha',
        'hora',
        'id_tarjeta',
        'id_usuario',
        'monto',
        'numerounico',
        'numtarj',
        'periodo',
        'plataforma',
        'procesado',
        'referenciapay',
        'resultadopay',
        'status',
        'tipotarj',
        'xid',
    ];

    private $tarjeta_bancaria_cache;

    public $timestamps = false;


    // Attributes

    public function getMontoConSeparadorAttribute()
    {
        return number_format($this->monto, 2, '.', ',');
    }

    public function getNumeroCuentaAttribute()
    {
        return $this->cuenta;
    }

    public function getCodigoPeriodoAttribute()
    {
        return $this->periodo;
    }

 
    // Scopes

    public function scopeAprobadas($query)
    {
        return $query->where('resultadopay', 'A');
    }

    public function scopeNoBorradas($query)
    {
        return $query->where('borrado', 0);
    }

    public function scopeWhereCuenta($query, $numero_cuenta)
    {
        return $query->where('cuenta', $numero_cuenta);
    }

    public function scopeWherePeriodo($query, $periodo)
    {
        return $query->where('periodo', $periodo);
    }

    public function scopeVigente($query, $id = null)
    {
        if(! is_null($id) )
            $query->where('id', $id);

        return $query->whereDate('fecha_hora_3dsecure', '=', date('Y-m-d'));
    }


    // Relaciones

    public function padron()
    {
        return $this->belongsTo(Padron::class, 'cuenta', 'CUENTA');
    }


    // Tarjeta bancaria

    public function tarjetaBancariaDecodificada()
    {
        if( is_null($this->tarjeta_bancaria_cache) )
            $this->tarjeta_bancaria_cache = TarjetaBancaria::decodificada($this->id_tarjeta)->first();

        return $this->tarjeta_bancaria_cache;
    }

    public function getTarjetaBancariaAttribute()
    {
        return $this->tarjetaBancariaDecodificada();
    }


    // Interfaces

    public static function calcularSaldo(Factura $factura)
    {
        if(! $transacciones = self::aprobadas()->noBorradas()->whereCuenta($factura->numero_cuenta)->wherePeriodo($factura->PERIODO)->get() )
            return;

        return $transacciones->sum('monto');
    }


    // Guardar

    public static function guardarRespuesta3DS(TarjetaBancaria $tarjeta_bancaria, Factura $factura, Respuesta3DS $respuesta3DS)
    {
        $preparados = self::prepararGuardarRespuesta3DS($tarjeta_bancaria, $factura, $respuesta3DS);
        return self::create($preparados);
    }

    public static function prepararGuardarRespuesta3DS(TarjetaBancaria $tarjeta_bancaria, Factura $factura, Respuesta3DS $respuesta3DS)
    {
        return [
			'monto' => $factura->importe_transaccion,
			'cavv' => $respuesta3DS->cavv,
			'eci' => $respuesta3DS->eci,
			'expira' => $tarjeta_bancaria->expira,
			'fecha_hora_3dsecure' => now(),
			'id_tarjeta' => $tarjeta_bancaria->id,
			'id_usuario' => Auth::id(),
            'numerounico' => PeticionPWS::generarNumeroControl( $respuesta3DS->referencia3D ),
			'numtarj' => $tarjeta_bancaria->ultimos_cuatro_digitos,
			'periodo' => $factura->codigo_periodo,
			'plataforma' => MovimientoWeb::AMBITO,
			'status' => $respuesta3DS->estatus->codigo,
			'tipotarj' => Peticion3DS::obtenerMarcaTarjetaBancaria( $tarjeta_bancaria->nombre_red ),
			'xid' => $respuesta3DS->xid,
            'cuenta' => $factura->numero_cuenta,
        ];
    }


    // Actualizar

    public static function actualizarRespuestaPayworks(RespuestaPWS $respuestaPWS, int $transaccion_id)
    {
        $preparados = self::prepararActualizarRespuestaPayworks($respuestaPWS);
        self::where('id', $transaccion_id)->update($preparados);
        return self::find($transaccion_id);
    }

    public static function prepararActualizarRespuestaPayworks(RespuestaPWS $respuestaPWS)
    {
        return [
            'fecha' => $respuestaPWS->fecha('FECHA_RSP_CTE'),
            'hora' => $respuestaPWS->hora('FECHA_RSP_CTE'),
            'codigo_payw_rechazo' => $respuestaPWS->rechazado->codigo,
            'codigoautpay' => $respuestaPWS->aprobado->codigo,
            'resultadopay' => $respuestaPWS->resultado->codigo,
            'referenciapay' => $respuestaPWS->campo('REFERENCIA'),
        ];
    }
}

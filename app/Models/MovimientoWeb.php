<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MovimientoWeb extends Model
{
    const AMBITO = 'WEB';

    const CODIGO_AMBITO = 'W';

    protected $table = 'movweball';

    protected $claves_movimientos = [
        0 => 'ninguno',
		1 => 'guardo',
		2 => 'actualizo',
		3 => 'elimino',
		// 4 => '?',
		// 5 => '?',
		// 6 => '?',
		9 => 'desconocido',
    ];

	protected $fillable = [
		'idmov',
		'idtar',
		'tipomov',
		'fecha',
		'hora',
		'desde',
	];

	public $timestamps = false;


	// Estaticos

	public static function guardar($tarjeta_bancaria_id, $clave_movimiento)
	{
		$data = [
			'idmov' => Auth::id(),
			'idtar' => $tarjeta_bancaria_id,
			'tipomov' => $clave_movimiento,
			'fecha' => date('Y-m-d'),
			'hora' => date('H:i:s'),
			'desde' => self::AMBITO,
		];

		return self::create($data);
	}


	// Atajos estaticos

	public static function guardoTarjetaBancaria($tarjeta_bancaria_id)
	{
		return self::guardar($tarjeta_bancaria_id, 1);
	}

	public static function actualizoTarjetaBancaria($tarjeta_bancaria_id)
	{
		return self::guardar($tarjeta_bancaria_id, 2);
	}

	public static function eliminoTarjetaBancaria($tarjeta_bancaria_id)
	{
		return self::guardar($tarjeta_bancaria_id, 3);
	}
}

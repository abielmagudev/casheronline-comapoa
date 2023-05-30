<?php

namespace App\Outsourcing\Banorte\ThreeDSecure;

class CodigoEstatus3DS extends Codigos3DS
{
	public $codigo;

	public function __construct(string $codigo)
	{
		$this->codigo = $codigo;
	}

	public function descripcion(string $predeterminado = 'Sin descripción')
	{
		return self::obtenerDescripcion($this->codigo) ?? $predeterminado;
	}
	
	public function mensaje(string $predeterminado = 'Sin mensaje')
	{
		return self::obtenerMensaje($this->codigo) ?? $predeterminado;
	}

	public function estaAprobado()
	{
		return self::verificarAprobacion($this->codigo);
	}
}

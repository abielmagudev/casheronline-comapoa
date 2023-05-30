<?php 

namespace App\Outsourcing\Banorte\ThreeDSecure;

class Codigos3DS
{
    const CODIGO_APROBADO = 200;
	
	/**
	* ManualDeIntegración_3DSecure2.0_V1.2: pag.10 
	*/
	public static $codigos_descripciones = [
		102 => 'Tarjeta inválida',
		200 => 'Indica que la transacción es segura y se puede enviar a Payworks.',
		201 => 'Indica que se detecto un error general en el sistema de Visa o Master Card, se recomienda esperar unos momentos para reintentar la transacción.',
		421 => 'Indica que el servicio 3D Secure no está disponible, se recomienda esperar unos momentos para reintentar la transacción.',
		422 => 'Indica que hubo un problema genérico al momento de realizar la Autenticación, no se debe enviar la transacción a Payworks.',
		423 => 'Indica que la Autenticación no fue exitosa, no se debe enviar la transacción a Payworks ya que el comprador no se pudo autenticar con éxito.',
		424 => 'Autenticación 3D Secure no fue completada. NO se debe enviar a procesar la transacción al motor de pagos Payworks, ya que la persona no está ingresando correctamente la contraseña 3D Secure.',
		425 => 'Autenticación Inválida. Indica que definitivamente NO se debe enviar a procesar la transacción a Payworks, ya que la persona no está ingresando correctamente la contraseña3D Secure.',
		426 => 'Afiliación no encontrada. Indica que NO existe la afiliación ingresada por el usuario en el programa 3D Secure.',
		430 => 'Tarjeta de Crédito nulo, la variable Card se envió vacía.',
		431 => 'Fecha de expiración nulo, la variable Expires se envió vacía.',
		432 => 'Monto nulo, la variable Total se envió vacía.',
		433 => 'Id del comercio nulo, la variable MerchantId se envió vacía.',
		434 => 'Liga de retorno nula, la variable ForwardPath se envió vacía.',
		435 => 'Nombre del comercio nulo, la variable MerchantName se envió vacía.',
		436 => 'Formato de TC incorrecto, la variable Card debe ser de 16 dígitos.',
		437 => 'Formato de Fecha de Expiración incorrecto, la variable Expires debe tener el siguiente formato: MM/YY donde MM se refiere al mes, YY se refiere al año de vencimiento de la tarjeta.',
		438 => 'Fecha de Expiración incorrecto, indica que el plástico esta vencido.',
		439 => 'Monto incorrecto, la variable Total debe ser un número menor a 999,999,999,999.', // Con la fracción decimal opcional, esta debe ser a lo más de 2 décimas.
		440 => 'Formato de nombre del comercio incorrecto, debe ser una cadena de máximo 25 caracteres alfanuméricos.',
		441 => 'Marca de Tarjeta nulo, la variable CardType se envió vacía.',
		442 => 'Marca de Tarjeta incorrecta, debe ser uno de los siguientes valores: VISA (para tarjetas Visa) o MC (para tarjetas Master Card).',
		443 => 'CardType incorrecto, se ha especificado el CardType como VISA, sin embargo, el Bin de la tarjeta indica que esta no es Visa.',
		444 => 'CardType incorrecto, se ha especificado el CardType como MC, sin embargo, el Bin de la tarjeta indica que esta no es Master Card.',
		445 => 'CardType incorrecto, se ha especificado el CardType como AMEX, sin embargo, el programa no acepta esta marca por el momento.', 
		446 => 'Monto incorrecto, la variable Total debe ser superior a 1.0 pesos.',
		447 => 'Referencia 3D nula, la variable reference3D se envió vacía.',
		448 => 'Cert3D nula, la variable Cert3D se envió vacía.',
		498 => 'Transacción expirada. Indica que la transacción sobrepasó el límite de tiempo de respuesta esperado.',
		499 => 'Usuario excedió el tiempo de respuesta. Indica que el usuario tardó en capturar la información de 3D Secure mayor al tiempo esperado.', 
		450 => 'El módulo 3D Secure Plus se encuentra inhabilitado para la afiliación (MerchantId) ingresada.',
		451 => 'El ‘XXXX’ es un campo obligatorio', 
		452 => 'El campo ‘XXXX’ excede la longitud permitida de ‘XXXX’ caracteres',
		453 => 'El campo ‘XXXX’ no es un numérico.',
		454 => 'No se pudo recibir respuesta de cruise hybrid lookup.',
		455 => 'Error al crear el JWT Claim.',
		456 => 'JWT mal formado.',
	];
	
	/**
	 * Agrupa códigos para un mensaje abstracto
	 */
	public static $mensaje_codigos = [
		// Tarjeta bancaria
		'Actualiza ó corrige información de la tarjeta bancaria.' => [
			102,
			430,
			431,
			436,
			437,
			438,
			441,
			442,
			443,
			444,
			445,
			451,
			452,
			453,
		],

		// Autenticación
		'Autenticación sin éxito, intenta nuevamente.' => [
			422,
			423,
			424,
			425,
		],

		// Expiración
		'Expiró tiempo de validación, intenta nuevamente.' => [
			498,
			499,
		],

		// Monto de la transacción
		'El monto de la transacción no es correcto.' => [
			432,
			439,
			446,
		],

		// Paga en línea (Plataforma de pagos)
		'Error en la plataforma de pagos, inténtalo nuevamente, en caso de persistir, reportarlo a soporte técnico.' => [
			426,
			433,
			434,
			435,
			440,
			447,
			448,
		],

		// Sistema del banco (Proveedor)
		'Error en el sistema bancario, inténtalo más tarde.' => [
			201,
			421,
			450,
			454,
			455,
			456,
		],
	];


	// Obtenedores

	public static function obtenerDescripcion(string $codigo)
	{
		return array_key_exists($codigo, self::$codigos_descripciones) ? self::$codigos_descripciones[$codigo] : false;
	}

	public static function obtenerMensaje(string $codigo, string $predeterminado = null)
	{
		$filtrado = array_filter(self::$mensaje_codigos, fn($codigos) => in_array($codigo, $codigos));
		return key($filtrado) ?? $predeterminado;
	}


	// Validadores

	public static function existe($codigo)
	{
		return array_key_exists($codigo, self::$codigos_descripciones);
	}

	public static function verificarAprobacion(string $codigo)
	{
		return $codigo == self::CODIGO_APROBADO;
	}
}

/**

ManualDeIntegración_3DSecure2.0_V1.2: pag.10 

CÓDIGOS DE STATUS

102 Tarjeta inválida. / Invalid card.

200 Indica que la transacción es segura y se puede enviar a Payworks.

201 Indica que se detecto un error general en el sistema de Visa o Master Card, se recomienda esperar unos momentos para reintentar la transacción.

421 Indica que el servicio 3D Secure no está disponible, se recomienda esperar unos momentos para reintentar la transacción.

422 Indica que hubo un problema genérico al momento de realizar la Autenticación, no se debe enviar la transacción a Payworks.

423 Indica que la Autenticación no fue exitosa, no se debe enviar la transacción a Payworks ya que el comprador no se pudo autenticar con éxito.

424 Autenticación 3D Secure no fue completada. NO se debe enviar a procesar la transacción al motor de pagos Payworks, ya que la persona no está ingresando correctamente la contraseña 3D Secure.

425 Autenticación Inválida. Indica que definitivamente NO se debe enviar a procesar la transacción a Payworks, ya que la persona no está ingresando correctamente la contraseña3D Secure.

426 Afiliación no encontrada. Indica que NO existe la afiliación ingresada por el usuario en el programa 3D Secure.

430 Tarjeta de Crédito nulo, la variable Card se envió vacía.

431 Fecha de expiración nulo, la variable Expires se envió vacía.

432 Monto nulo, la variable Total se envió vacía.

433 Id del comercio nulo, la variable MerchantId se envió vacía.

434 Liga de retorno nula, la variable ForwardPath se envió vacía.

435 Nombre del comercio nulo, la variable MerchantName se envió vacía.

436 Formato de TC incorrecto, la variable Card debe ser de 16 dígitos.

437 Formato de Fecha de Expiración incorrecto, la variable Expires debe tener el siguiente formato: MM/YY donde MM se refiere al mes, YY se refiere al año de vencimiento de la tarjeta.

438 Fecha de Expiración incorrecto, indica que el plástico esta vencido.

439 Monto incorrecto, la variable Total debe ser un número menor a 999,999,999,999.## con la fracción decimal opcional, esta debe ser a lo más de 2 décimas.

440 Formato de nombre del comercio incorrecto, debe ser una cadena de máximo 25 caracteres alfanuméricos.

441 Marca de Tarjeta nulo, la variable CardType se envió vacía.

442 Marca de Tarjeta incorrecta, debe ser uno de los siguientes valores: VISA (para tarjetas Visa) o MC (para tarjetas Master Card).

443 CardType incorrecto, se ha especificado el CardType como VISA, sin embargo, el Bin de la tarjeta indica que esta no es Visa.

444 CardType incorrecto, se ha especificado el CardType como MC, sin embargo, el Bin de la tarjeta indica que esta no es Master Card.

445 CardType incorrecto, se ha especificado el CardType como AMEX, sin embargo, el programa no acepta esta marca por el momento.

446 Monto incorrecto, la variable Total debe ser superior a 1.0 pesos.

447 Referencia 3D nula, la variable reference3D se envió vacía.

448 Cert3D nula, la variable Cert3D se envió vacía.

498 Transacción expirada. Indica que la transacción sobrepasó el límite de tiempo de respuesta esperado.

499 Usuario excedió el tiempo de respuesta. Indica que el usuario tardó en capturar la información de 3D Secure mayor al tiempo esperado.

450 El módulo 3D Secure Plus se encuentra inhabilitado para la afiliación (MerchantId) ingresada.

451 El ‘XXXX’ es un campo obligatorio. / ‘XXXX’ – This field is required.

452 El campo ‘XXXX’ excede la longitud permitida de ‘XXXX’ caracteres. / ‘XXXX’ is too large (max length of ‘XXXX’ characters).

453 El campo ‘XXXX’ no es un numérico. / ‘XXXX’ – This field only allows numeric values.

454 No se pudo recibir respuesta de cruise hybrid lookup. / It can’t reply cruise hybrid lookup response.

455 Error al crear el JWT Claim. / Failed creation JWT Claim.

456 JWT mal formado. / JWT corrupted.

*/

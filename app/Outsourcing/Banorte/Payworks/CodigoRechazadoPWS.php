<?php

namespace App\Outsourcing\Banorte\Payworks;

/**
 * ManualDeIntegracion_ComercioElectrónico_V2.1 (pág. 11, 18)
 * 
 * CODIGO_PAYW/PAYW_CODE
 */
class CodigoRechazadoPWS
{
    // Idiomas disponibles: esp || eng
    const IDIOMA_PREDETERMINADO = 'esp';

    public static $codigos_mensajes = [
	
		// PROBLEMAS RELACIONADOS CON TLS

		'0001' => [
			'eng' => 'Platform does not support requested TLS algorithm.',
			'esp' => 'El algoritmo definido para encriptar en TLS no está soportado en esta plataforma.',
		],
		'0002' => [
			'eng' => 'Unexpected error when trying to access local keystore.',
			'esp' => 'Falla inesperada al accesar almacén de llaves (keystore).',
		],
		'0003' => [
			'eng' => 'The keystore could not be found at the configured location.',
			'esp' => 'El almacén de llaves (keystore) especificado no existe en la ubicación configurada.',
		],
		'0004' => [
			'eng' => 'The keystore is not valid or is corrupted.',
			'esp' => 'El almacén de llaves (keystore) configurado no es válido o está correcto.',
		],
		'0005' => [
			'eng' => 'Access to keystore is not allowed.',
			'esp' => 'El acceso al almacén de llaves (keystore) fue denegado por falta de permisos.',
		],
		'0006' => [
			'eng' => 'General failure during TLS handshaking.',
			'esp' => 'Falla general de seguridad en manejo de socket TLS.',
		],
	
	
		// PROBLEMAS RELACIONADOS CONN SERVIDOR TCP
		
		'0101' => [
			'eng' => 'Socket server cannot be started.',
			'esp' => 'Falla al inicializar servidor de sockets.',
		],
		
		
		// PROBLEMAS RELACIONADOS CON CLIENTE TCP
		
		'0201' => [
			'eng' => 'Client was unable to create socket to connect to server xxx.',
			'esp' => 'Falla al intentar crear socket en cliente hacia servidor xxx.',
		],
		'0202' => [
			'eng' => 'Unable to connect to server xxx.',
			'esp' => 'Incapaz de establecer conexión con servidor xxx.',
		],
		'0203' => [
			'eng' => 'Connection to server xxx has been closed. Trying to reconnect.',
			'esp' => 'No se tiene conexión actualmente con el servidor xxx. Se intenta reconexión.',
		],
		
		
		// PROBLEMAS RELACIONADOS CON MENSAJERIA ISO
		
		'1001' => [
			'eng' => 'Received ISO message does not meet the expected format.',
			'esp' => 'El mensaje ISO recibido no tiene el formato esperado.',
		],
		'1002' => [
			'eng' => 'Invalid TPU in the received ISO message.',
			'esp' => 'El mensaje ISO recibido contiene una TPDU no válida.',
		],
		'1003' => [
			'eng' => 'The bitmap in the received ISO message is not valid.',
			'esp' => 'El mensaje ISO recibido no tiene un mapa de bits consistente.',
		],
		'1004' => [
			'eng' => 'Received ISO message has an invalid suffix.',
			'esp' => 'El mensaje ISO recibido tiene un terminador no válido.',
		],
		'1005' => [
			'eng' => 'Failure when trying to decode field xxx.',
			'esp' => 'Falla al decodificar el campo xxx.',
		],
		'1006' => [
			'eng' => 'Failure when trying to encode xxx. Value\: "yyy"',
			'esp' => 'Falla al codificar el campo xxx. Valor\: "yyy"',
		],
		'1007' => [
			'eng' => 'Field contents in the ISO message exceeds the maximum allowed.',
			'esp' => 'El contenido del campo excede el máximo permissible.',
		],
		'1008' => [
			'eng' => 'Unexpected type for field xxx in the ISO message.',
			'esp' => 'El tipo del campo xxx no es del tipo esperado.',
		],
		'1009' => [
			'eng' => 'Charset ISO-8859-1 is not supported in the current execution platform.',
			'esp' => 'El juego de caracteres ISO-8859-1 no está soportado en esta plataforma.',
		],
		'1010' => [
			'eng' => 'Incomplete field xxx in the ISO message.',
			'esp' => 'El campo xxx está incomplete en el mensaje ISO.',
		],
		'1011' => [
			'eng' => 'Invalid field xxx in the ISO message.',
			'esp' => 'El campo xxx no es válido.',
		],
		'1012' => [
			'eng' => 'Variable length for field xxx exceeds value specified in the prefix.',
			'esp' => 'La longitud del campo variable xxx excede lo indicado en el prefijo.',
		],
		'1013' => [
			'eng' => 'Field xxx has an invalid content.',
			'esp' => 'El contenido del campo xxx no es válido.',
		],
		'1014' => [
			'eng' => 'POS Entry Mode (field 22) has an invalid value.',
			'esp' => 'El modo de entrada (campo 22) no es válido.',
		],
		'1015' => [
			'eng' => 'Field xxx is required but was not included in the ISO message.',
			'esp' => 'El campo xxx es requerido y no fue incluido en el mensaje ISO.',
		],
		'1016' => [
			'eng' => 'Statistical message does not have the expected format.',
			'esp' => 'El mensaje de estadísticos recibido no tiene el formato esperado.',
		],
		'1017' => [
			'eng' => 'Unable to recognize transaction sent by device.',
			'esp' => 'No ha sido posible identificar el tipo de transacción enviada por el dispositivo.',
		],
		'1018' => [
			'eng' => 'Information about Q6 promotion is not valid.',
			'esp' => 'La información de promoción Q6 es inválida.',
		],
			
		
		// PROBLEMAS RELACIONADOS CON INTERFAZ HTTP
		
		'2001' => [
			'eng' => 'Unexpected failure when processing command/transaction.',
			'esp' => 'Falla inesperada al intentar procesar transacción.',
		],
		'2002' => [
			'eng' => 'Parameter "xxx" cannot be provided for a manual transaction.',
			'esp' => 'El parámetro "xxx" no puede incluirse en una transacción manual.',
		],
		'2003' => [
			'eng' => 'Parameter "xxx" cannot be provided for transaction with a swiped/inserted card.',
			'esp' => 'El parámetro "xxx" no puede incluirse en una transacción con plástico presente.',
		],
		'2004' => [
			'eng' => 'Parameter "xxx" with value "yyy" can only be provided for a transaction with a chip card.',
			'esp' => 'El parámetro "xxx" con valor "yyy" sólo es requerido en una transacción de chip.',
		],
		'2005' => [
			'eng' => 'Parameter "xxx" with value "yyy" cannot be accepted for a manual transaction.',
			'esp' => 'El parámetro "xxx" con valor "yyy" no es compatible con una transacción manual.',
		],
		'2006' => [
			'eng' => 'Parameter "xxx" with value "yyy" cannot be accepted for a swiped / inserted card.',
			'esp' => 'El parámetro "xxx" con valor "yyy" no es compatible con una transacción con plástico presente.',
		],
		'2007' => [
			'eng' => 'Promotional transaction requires some missing fields.',
			'esp' => 'La información sobre la promoción en la transacción no está complete.',
		],
		'2008' => [
			'eng' => 'Parameter "xxx" with value "yyy" specifies an expired date.',
			'esp' => 'El parámetro "xxx" con valor "yyy" corresponde a una fecha expirada.',
		],
		'2009' => [
			'eng' => 'Command requires either "REFERENCE" or "CONTROL_NUMBER".',
			'esp' => 'El comando requiere "REFERENCIA" o "NUMERO_CONTROL".',
		],
		'2010' => [
			'eng' => 'Required parameter "CMD_TRANS" was not supplied.',
			'esp' => 'No se especificó el parámetro requerido "CMD_TRANS".',
		],
		'2011' => [
			'eng' => 'Requested Command/transaction "xxx" is not valid or not supported.',
			'esp' => 'El comando/transacción "xxx" no es válido(a) o no está soportado(a).',
		],
		'2012' => [
			'eng' => 'Value "yyy" supplied for parameter "xxx" is not valid.',
			'esp' => 'El valor "yyy" suministrado para el parámetro "xxx" es inválido.',
		],
		'2013' => [
			'eng' => 'Value "yyy" supplied for parameter "xxx" exceeds maximum allowed length\: zzz.',
			'esp' => 'El valor "yyy" suministrado para el parámetro "xxx" excede la longitud máxima permitida\: zzz.',
		],
		'2014' => [
			'eng' => 'Parameter "xxx" cannot be null.',
			'esp' => 'El parámetro "xxx" no puede ser nulo.',
		],
		'2015' => [
			'eng' => 'No response received for the command / transaction.',
			'esp' => 'No hubo respuesta para el comando / transacción.',
		],
		'2016' => [
			'eng' => 'Parameters "XID" y "CAVV" are required for this type of transaction.',
			'esp' => 'Los parámetros "XID" y "CAVV" son obligatorios para este tipo de transacción.',
		],
		'2017' => [
			'eng' => 'Failure while trying to decypher transaction data.',
			'esp' => 'Falla al intentar descifrar campos de transacción.',
		],
		'2018' => [
			'eng' => 'The following parameter is required to process the request: "".',
			'esp' => 'El siguiente parámetro es requerido para procesar el requerimiento: "".',
		],
		'2019' => [
			'eng' => 'The key needed to decrypt data from this device has not been loaded or is not available.',
			'esp' => 'La llave necesaria para procesar datos cifrados no ha sido cargada para este dispositivo o no está disponible.',
		],
		'2020' => [
			'eng' => 'Unable to decrypt data received at the "INTERREDES" channel.',
			'esp' => 'Falla al intentar descifrar requerimiento enviado al canal "INTERREDES".',
		],
		'2021' => [
			'eng' => 'Parameter "" cannot accept negative values.',
			'esp' => 'El parámetro "" no puede aceptar valores negativos.',
		],
		'2022' => [
			'eng' => 'Response url not valid.',
			'esp' => 'Respuesta url no válida.',
		],
		'2023' => [
			'eng' => 'Control number not secure.',
			'esp' => 'El numero de control no es seguro.',
		],
		'2024' => [
			'eng' => 'Response url not valid.',
			'esp' => 'Respuesta url no válida.',
		],
		
		
		// PROBLEMAS RELACIONADOS CON COMANDOS Y TRANSACCIONES
		
		'3001' => [
			'eng' => 'Unable to execute command/transaction; please retry later.',
			'esp' => 'Incapaz de realizar operación. Por favor intente más tarde.',
		],
		'3002' => [
			'eng' => 'Invalid Affiliation / User.',
			'esp' => 'La afiliación o el usuario proporcionados no existen.',
		],
		'3003' => [
			'eng' => 'Invalid User / Password.',
			'esp' => 'Usuario o contraseña inválidos.',
		],
		'3004' => [
			'eng' => 'Affiliation xxx is currently inactive.',
			'esp' => 'La afiliación xxx no se encuentra active.',
		],
		'3005' => [
			'eng' => 'Client xxx is currently inactive.',
			'esp' => 'El cliente xxx no se encuentra active.',
		],
		'3006' => [
			'eng' => 'Client xxx is currently inactive.',
			'esp' => 'El cliente xxx no se encuentra active.',
		],
		'3007' => [
			'eng' => 'User xxx is not allowed to execute commands / transactions.',
			'esp' => 'El usuario xxx no tiene el permiso necesario para ejecutar comandos/transacciones.',
		],
		'3008' => [
			'eng' => 'Terminal xxx does not exist for this affiliation.',
			'esp' => 'La terminal xxx no existe para esta afiliación.',
		],
		'3009' => [
			'eng' => 'Terminal xxx is currently inactive.',
			'esp' => 'La terminal xxx no se encuentra active.',
		],
		'3010' => [
			'eng' => 'Card brand / terminal do not allow this type of transaction.',
			'esp' => 'Transacción no permitida para esta terminal y marca de tarjeta.',
		],
		'3011' => [
			'eng' => 'Command xxx is not currently supported.',
			'esp' => 'El comando xxx no está soportado actualmente.',
		],
		'3012' => [
			'eng' => 'Referred transaction xxx does not exist.',
			'esp' => 'La transacción referenciada xxx no existe.',
		],
		'3013' => [
			'eng' => 'Referred transaction xxx has been previously cancelled.',
			'esp' => 'La transacción referenciada xxx ha sido cancelada previamente.',
		],
		'3014' => [
			'eng' => 'Rejected: The total amount for transaction xxx has been already refunded.',
			'esp' => 'Rechazada: El 100% del importe de la transacción referenciada xxx ya ha sido devuelto.',
		],
		'3015' => [
			'eng' => 'Rejected: Partial refunds have been already applied to referred transaction xxx.',
			'esp' => 'Rechazada: La transacción referenciada xxx ya tiene devoluciones parciales aplicadas.',
		],
		'3016' => [
			'eng' => 'Illegal to execute a refund on the referred transaction xxx.',
			'esp' => 'La transacción referenciada xxx no permite devoluciones.',
		],
		'3017' => [
			'eng' => 'Refund requires the referred transaction xxx to be closed first (still open).',
			'esp' => 'No es posible efectuar una devolución sobre la transacción xxx, la cual no ha sido cerrada.',
		],
		'3018' => [
			'eng' => 'Amount requested in the refund xxx exceeds the maximum allowed: yyy.',
			'esp' => 'El importe de la devolución por xxx excede el máximo disponible: yyy.',
		],
		'3019' => [
			'eng' => 'Not allowed to close a reauthorization; please use the original preauthorization.',
			'esp' => 'No se admite el cierre de reautorizaciones; utilice la preautorización original.',
		],
		'3020' => [
			'eng' => 'Postauthorizations are only valid for open preauthorizations.',
			'esp' => 'Sólo se permiten postautorizaciones para preautorizaciones abiertas.',
		],
		'3021' => [
			'eng' => 'Postauthorization´s amount of xxx exceeds the maximum allowed: yyy',
			'esp' => 'El monto de la postautorización por xxx excede el máximo disponible: yyy',
		],
		'3022' => [
			'eng' => 'Reauthorizations are only valid for open preauthorizations.',
			'esp' => 'Sólo se permiten reautorizaciones parapreautorizaciones abiertas.',
		],
		'3023' => [
			'eng' => 'Reauthorizations are not allowed for this application type: xxx',
			'esp' => 'El tipo de aplicación xxx no permite reautorizaciones.',
		],
		'3024' => [
			'eng' => 'Illegal to execute a cancellation on the referred transaction xxx.',
			'esp' => 'La transacción referenciada xxx no permite cancelaciones.',
		],
		'3025' => [
			'eng' => 'Cancellation requires the referred transaction xxx to be closed first (still open).',
			'esp' => 'No es posible efectuar una cancelación sobre la transacción xxx, la cual no ha sido cerrada.',
		],
		'3026' => [
			'eng' => 'Not allowed to execute cancellations.',
			'esp' => 'No tiene el permiso para ejecutar una cancelación.',
		],
		'3027' => [
			'eng' => 'Not allowed to execute a cashback.',
			'esp' => 'No tiene el permiso para ejecutar una transacción de cashback.',
		],
		'3028' => [
			'eng' => 'Not allowed to execute a credit.',
			'esp' => 'La transacción de crédito directo no está habilitada.',
		],
		'3029' => [
			'eng' => 'Not allowed to execute a refund.',
			'esp' => 'No se tiene el permiso necesario para ejecutar una transacción de Devolución.',
		],
		'3030' => [
			'eng' => 'Unrestricted or late refunds are not allowed.',
			'esp' => 'No se tiene el permiso necesario para ejecutar una transacción de Devolución.',
		],
		'3031' => [
			'eng' => 'Not allowed to execute transactions including promotions.',
			'esp' => 'No se tiene el permiso necesario para efectuar una transacción con promoción.',
		],
		'3032' => [
			'eng' => 'Not allowed to execute QPS transactions.',
			'esp' => 'No se tiene el permiso necesario para ejecutar transacciones QPS.',
		],
		'3033' => [
			'eng' => 'Not allowed to execute a forced authorization.',
			'esp' => 'No se tiene el permiso necesario para realizar una venta forzada.',
		],
		'3034' => [
			'eng' => 'Amount exceeds the maximum allowed for a QPS transaction.',
			'esp' => 'El monto indicado en la transacción QPS excede el máximo permissible.',
		],
		'3035' => [
			'eng' => 'Affiliation requires a valid terminal number to be supplied.',
			'esp' => 'La afiliación requiere que se proporcione una terminal válida.',
		],
		'3036' => [
			'eng' => 'Default terminal does not exist in the database.',
			'esp' => 'La terminal por defecto no ha sido creada en la base de datos.',
		],
		'3037' => [
			'eng' => 'Card type xxx is not currently Supported.',
			'esp' => 'No hay soporte para las tarjetas de marca xxx.',
		],
		'3038' => [
			'eng' => 'Authorizer xxx is not currently supported.',
			'esp' => 'No hay soporte para el autorizador xxx.',
		],
		'3039' => [
			'eng' => 'Control number xxx has been already used for a previous transaction.',
			'esp' => 'El No. de Control xxx ya existe para una transacción anterior.',
		],
		'3040' => [
			'eng' => 'Transactions with amount zero are not valid.',
			'esp' => 'No se permite monto cero en una transacción.',
		],
		'3041' => [
			'eng' => 'FALLBACK transactions are not allowed.',
			'esp' => 'Las transacciones FALLBACK no están permitidas.',
		],
		'3042' => [
			'eng' => 'The 3DSecure eCommerce indicator (ECI) received for this transaction is not allowed.',
			'esp' => 'El indicador de 3DSecure (ECI) recibido para esta transacción no está permitido.',
		],
		'3043' => [
			'eng' => 'Previous operation required by this transacction could not be executed.',
			'esp' => 'La operación previa requerida para ejecutar esta transacción no tuvo éxito.',
		],
		'3044' => [
			'eng' => 'Previous operation required by this transacction was declined by authorizer.',
			'esp' => 'La operación previa requerida para ejecutar esta transacción fue declinada por el autorizador.',
		],
		'3045' => [
			'eng' => 'No response received for previous operation required by this transaction.',
			'esp' => 'La operación previa requerida para ejecutar esta transacción no tuvo respuesta.',
		],
		'3046' => [
			'eng' => 'The security code is required and was not supplied.',
			'esp' => 'El código de seguridad es requerido y no fue proporcionado.',
		],
		'3047' => [
			'eng' => 'Transaction entry mode is not allowed for affiliation type: xxx.',
			'esp' => 'El modo de entrada de la transacción no es compatible con el tipo de afiliacion: xxx.',
		],
		'3048' => [
			'eng' => 'No manual entry mode for transactions is allowed.',
			'esp' => 'No se tiene el permiso necesario para ejecutar transacciones digitadas o manuales.',
		],
		'3049' => [
			'eng' => 'Referred transaction xxx has been previously cancelled.',
			'esp' => 'La transacción referenciada xxx ya había sido reversada.',
		],
		'3050' => [
			'eng' => 'The referred transaction cannot be reversed.',
			'esp' => 'La transacción referenciada no admite reversas.',
		],
		'3051' => [
			'eng' => 'Referred transaction xxx had not been approved.',
			'esp' => 'La transacción referenciada xxx se encuentra en estado de suspensión.',
		],
		'3052' => [
			'eng' => 'Referred transaction xxx is currently locked.',
			'esp' => 'La transacción referenciada xxx se encuentra en estado de suspensión.',
		],
		'3053' => [
			'eng' => 'Cashback is only allowed for transactions with card present (CHIP / MAGSTRIPE).',
			'esp' => 'La transacción de cashback sólo está permitida con plástico presente (CHIP / BANDA).',
		],
		'3054' => [
			'eng' => 'No transaction was found for the affiliation / terminal supplied.',
			'esp' => 'No se encontró ninguna transacción para la afiliación/terminal suministrados.',
		],
		'3055' => [
			'eng' => 'Referred transaction exists, but it was not generated by the supplied terminal.',
			'esp' => 'La transacción referenciada existe, pero no fue generada por la terminal proporcionada.',
		],
		'3056' => [
			'eng' => 'Referred transaction exists, but it does not belong to the supplied affiliation.',
			'esp' => 'La transacción referenciada existe, pero no pertenece a la afiliación proporcionada.',
		],
		'3057' => [
			'eng' => 'Settlement for group xxx is already running; cannot be executed concurrently more than once.',
			'esp' => 'El cierre del lote xxx ya está en proceso; no puede ejecutarse concurrentemente más de una vez.',
		],
		'3058' => [
			'eng' => 'Settlement for this affiliation is already running; cannot be executed concurrently more than once.',
			'esp' => 'El cierre masivo para esta afiliación ya está en proceso; no puede ejecutarse concurrentemente más de una vez.',
		],
		'3059' => [
			'eng' => 'No transaction mode was sent (if it is an ISO transaction, please make sure that the affiliation is of type TPV).',
			'esp' => 'No se especificó modo de la transacción (si es ISO verifique que la afiliación sea de tipo TPV).',
		],
		'3060' => [
			'eng' => 'The affiliation is of type TPV. It is not valid to provide the MODE parameter.',
			'esp' => 'La afiliación es de tipo TPV;no es válido proporcionar el parámetro MODO.',
		],
		'3061' => [
			'eng' => 'The affiliation has been configured as aggregator but the format indicator is null.',
			'esp' => 'La afiliación ha sido configurada como agregador pero el indicador de formato es nulo.',
		],
		'3062' => [
			'eng' => 'The affiliation has been configured as aggregator; missing associated merchant is required (SUB_MERCHANT).',
			'esp' => 'La afiliación es un agregador; se requiere obligatoriamente el nombre del comercio asociado (SUB_AFILIACION).',
		],
		'3063' => [
			'eng' => 'This transaction is not acceptable under mobile payment mode.',
			'esp' => 'Esta transacción no es aceptable con pago móvil.',
		],
		'3064' => [
			'eng' => 'Not allowed to execute mobile payment transactions.',
			'esp' => 'No se tiene el permiso necesario para ejecutar transacciones de pago móvil.',
		],
		'3065' => [
			'eng' => 'This card cannot be used in mobile payment transactions.',
			'esp' => 'Esta tarjeta no está autorizada para realizar transacciones de pago móvil.',
		],
		'3066' => [
			'eng' => 'Mobile payment transactions can only be manually entered.',
			'esp' => 'La transacciones de pago móvil únicamente pueden ser digitadas.',
		],
		'3067' => [
			'eng' => 'Plan type xxx is not valid.',
			'esp' => 'El valor del tipo de plan suministrado xxx es inválido.',
		],
		'3068' => [
			'eng' => 'Promotion is not valid or not supported.',
			'esp' => 'La promoción proporcionada es inválida o no está soportada.',
		],
		'3069' => [
			'eng' => 'Plan type xxx conflicts with other data in the promotion.',
			'esp' => 'El tipo de plan xxx es inconsistente con la promoción proporcionada.',
		],
		'3070' => [
			'eng' => 'This transaction cannot be sent in test mode, since the referred transaction was sent in production mode.',
			'esp' => 'No se admite esta transacción en modo de prueba, ya que la transacción referenciada fue enviada en modo de producción.',
		],
		'3071' => [
			'eng' => 'This transaction cannot be sent in production mode, since the referred transaction was sent in test mode.',
			'esp' => 'No se admite esta transacción en modo de producción, ya que la transacción referenciada fue enviada en modo de prueba.',
		],
		'3072' => [
			'eng' => 'The requested cashback amount is below the minimum required.',
			'esp' => 'El monto a disponer en esta transacción está por debajo del mínimo requerido.',
		],
		'3073' => [
			'eng' => 'The requested cashback amount exceeds the maximum allowed.',
			'esp' => 'El monto a disponer en esta transacción excede el máximo autorizado.',
		],
		'3074' => [
			'eng' => 'The maximum number of cashback transactions allowed per day has been already reached.',
			'esp' => 'El número máximo de transacciones cashback que pueden ejecutarse en un día ha sido ya alcanzado.',
		],
		'3075' => [
			'eng' => 'Transacion rejected since it would cause the maximum allowed daily cashback disposal to be exceeded.',
			'esp' => 'Transacción rechazada ya que se excedería el monto máximo diario autorizado de disposición cashback.',
		],
		'3076' => [
			'eng' => 'Reauthorizations on a previous EMV transaction are not acceptable; a new preauthorization is required.',
			'esp' => 'No se admiten reautorizaciones de una transacción previa de tipo EMV; se requiere nueva lectura de plástico.',
		],
		'3077' => [
			'eng' => 'Amount exceeds maximum limit allowed for a manual transaction.',
			'esp' => 'El monto excede el tope máximo permisible para una transacción digitada.',
		],
		'3078' => [
			'eng' => 'One or more elements required by the referred transaction are empty.',
			'esp' => 'Uno o más elementos requeridos por la transacción referenciada no fueron proporcionados.',
		],
		'3079' => [
			'eng' => 'Selector validation for device serial number "" failed.',
			'esp' => 'Falla al validar el selector enviado para el pinpad con número de serie "".',
		],
		'3080' => [
			'eng' => 'Unable to cypher master key for device with serial number "".',
			'esp' => 'Falla al intentar cifrar la llave que se enviará al pinpad con número de serie "".',
		],
		'3081' => [
			'eng' => 'No terminal was found having the provided serial number "".',
			'esp' => 'No se encontró una terminal válida para el número de serie proporcionado "".',
		],
		'3082' => [
			'eng' => 'The device with serial number "" has not been assigned a key.',
			'esp' => 'El dispositivo con número de serie "" no cuenta con una llave asignada.',
		],
		'3083' => [
			'eng' => 'Unable to retrieve exception bins for the requesting customer.',
			'esp' => 'Falla al obtener lista de bines de excepción para el cliente solicitante.',
		],
		'3084' => [
			'eng' => 'Failure when trying to cipher list of exception bins requested by device with serial number "".',
			'esp' => 'Falla al intentar cifrar lista de bines de excepción que se enviará al dispositivo con número de serie "".',
		],
		'3085' => [
			'eng' => 'Referred transaction "" had not been approved.',
			'esp' => 'La transacción referenciada "" no había sido aprobada.',
		],
		'3086' => [
			'eng' => 'Transacion rejected. Use chip reader slot.',
			'esp' => 'Transacción rechazada, utilice lector chip.',
		],
		'3087' => [
			'eng' => 'Referred transaction {0} does not exist.',
			'esp' => 'La transacci\u00f3n referenciada {0} no existe.',
		],
		'3088' => [
			'eng' => 'Exceeded the days of the closing time limit.',
			'esp' => 'Excedi\u00f3 los d\u00EDas del tiempo l\u00EDmite de cierre.',
		],


		// PROBLEMAS RELACIONADOS CON AUTORIZADORES
		
		'4001' => [
			'eng' => 'Configuration for connector to authorizer xxx does not include any channel.',
			'esp' => 'El conector hacia el autorizador xxx no tiene canales configurados.',
		],
		'4002' => [
			'eng' => 'Authorizer xxx is not currently available.',
			'esp' => 'El autorizador xxx no está Disponible.',
		],
		'4003' => [
			'eng' => 'Transaction xxx is not supported for authorizer yyy.',
			'esp' => 'La transacción xxx no está soportada para el autorizador yyy.',
		],
		'4004' => [
			'eng' => 'Timeout for transaction xxx; response not received within the maximum amount of time.',
			'esp' => 'El tiempo máximo de espera para la transacción xxx ha sido excedido.',
		],
		'4005' => [
			'eng' => 'Authorizer requires track 1 for this transaction.',
			'esp' => 'El track 1 es requerido por el autorizador para esta transacción.',
		],
		'4006' => [
			'eng' => 'There is no information in the database about the specified affiliation/terminal for the authorizer xxx.',
			'esp' => 'No hay información en la base de datos sobreafiliación/terminal para enviar hacia el autorizador xxx.',
		],
		'4007' => [
			'eng' => 'There is no terminal id for the authorizer xxx.',
			'esp' => 'No existe no. de terminal para enviar hacia el autorizador xxx.',
		],
		'4008' => [
			'eng' => 'There is no merchant id for the authorizer xxx.',
			'esp' => 'No existe no. de afiliación para enviar hacia el autorizador xxx.',
		],
		'4009' => [
			'eng' => 'Invalid type plan ("xxx") for a promotion.',
			'esp' => 'El valor para el tipo de plan ("xxx") no es válido.',
		],
		'4010' => [
			'eng' => 'Plan type value ("xxx") mismatches other parameters in the promotion.',
			'esp' => 'El valor para el tipo de plan ("xxx") no es congruente con el resto de parámetros de la promoción.',
		],
		'4011' => [
			'eng' => 'Promotion must include initial deferment and/or payments number.',
			'esp' => 'La promoción debe incluir diferimiento inicial y/o número de pagos.',
		],
		'4012' => [
			'eng' => 'Failure to decode token xxx: Value ‘yyy’ for subfield zzz is not aceptable according to the specification.',
			'esp' => 'La información de EMV suministrada no es válida o está incompleta.',
		],
		'4013' => [
			'eng' => 'Failure to decode token xxx: Value "yyy" for subfield zzz is not aceptable according to the specification.',
			'esp' => 'Falla al decodificar token xxx: El valor "yyy" para el subcampo zzz no es aceptable de acuerdo a especificación.',
		],
		'4014' => [
			'eng' => 'Supplied EMV data does not contain element "" and it is required.',
			'esp' => 'El elemento "" no está presente en la información EMV suministrada y es requerido.',
		],
		'4015' => [
			'eng' => 'Element "" supplied as part of EMV data is invalid.',
			'esp' => 'El elemento "" suministrado en la información EMV es inválido.',
		],
		'4016' => [
			'eng' => 'Transaction "" is too old and will not be sent to the authorizer.',
			'esp' => 'La transacción "" fue recibida hace ya demasiado tiempo y no se enviará al autorizador.',
		],
		'4017' => [
			'eng' => 'Inconsistent card number.',
			'esp' => 'Número de tarjeta inconsistente.',
		],
		'4018' => [
			'eng' => 'Timeout for transaction ""; response not received within the maximum amount of time, it has reversal "".',
			'esp' => 'El tiempo máximo de espera para la transacción "" ha sido excedido, reversa generada "".',
		],
		
		
		// PROBLEMAS RELACIONADOS CON EL CONECTOR PROSA
		
		'4501' => [
			'eng' => "Falla al decodificar token '': el valor '' para el subcampo '' no es aceptable de acuerdo a especificación.",
			'esp' => "Falla al decodificar token '': el valor '' para el subcampo '' no es aceptable de acuerdo a especificación.",
		],
		

		// PROBLEMAS RELACIONADOS CON BASE DE DATOS

		'5000' => [
			'eng' => 'Failure when trying to execute operation in the database\: "".',
			'esp' => 'Falla al intentar ejecutar la siguiente operación en base de datos\: "".',
		],
		'5001' => [
			'eng' => 'Failure when trying to execute operation in the database: xxx.',
			'esp' => 'Falla al intentar ejecutar la siguiente operación en base de datos: xxx.',
		],
		

		// PROBLEMAS RELACIONADOS CON REGLAS DE PREVENCION DE FRAUDE

		'6001' => [
			'eng' => 'Transaction has been rejected due to application of rule xxx assigned to this affiliation.',
			'esp' => 'Transacción rechazada por aplicación de la regla xxx asignada para esta afiliación.',
		],
		'6002' => [
			'eng' => 'Rule xxx assigned to this affiliation contains errors in its formula.',
			'esp' => 'Transacción rechazada por error en la fórmula definida para la regla xxx asignada para esta afiliación.',
		],
		'6003' => [
			'eng' => 'Failure when executing formula defined for rule xxx assigned to this affiliation.',
			'esp' => 'Transacción rechazada por error en la fórmula definida para la regla xxx asignada para esta afiliación.',
		],
		'6004' => [
			'eng' => 'Class defined for rule xxx has not been implemented yet.',
			'esp' => 'La clase definida para la regla xxx no ha sido implementada.',
		],
		'6005' => [
			'eng' => 'Unable to créate executor for rule xxx.',
			'esp' => 'Falla al instanciar clase definida para la regla xxx.',
		],
		'6006' => [
			'eng' => 'Invalid search condition for rule xxx.',
			'esp' => 'Condición inválida de búsqueda en regla xxx.',
		],
		'6007' => [
			'eng' => 'The search table used in formula for rule xxx does not exist.',
			'esp' => 'La tala de búsqueda proporcionada en la fórmula para la regla xxx no existe.',
		],
		'6008' => [
			'eng' => 'The Excel file needed by formula defined for rule xxx does not exist.',
			'esp' => 'El archivo Excel requerido por la fórmula definida para la regla xxx no existe.',
		],
		'6009' => [
			'eng' => 'Failure when trying to access the }Excel file needed by formula defined for rule xxx.',
			'esp' => 'Falla al intentar accesar el archivo Excel requerido por la fórmula definida para la regla xxx.',
		],
		'6010' => [
			'eng' => 'Failure when querying table needed by rule xxx.',
			'esp' => 'Falla al ejecutar búsqueda en tabla requerida por la regla xxx.',
		],
		'6011' => [
			'eng' => 'Unable to load Excel driver required to execute rule xxx.',
			'esp' => 'Incapaz de cargar driver Excel para ejecutar regla xxx.',
		],
		'6012' => [
			'eng' => '="excep.regla.comercio" value="',
			'esp' => 'Variable configurable por el Comercio.',
		],
		

		// PROBLEMAS RELACIONADOS CON EL SERVICIO VISA CHECK OUT

		'6100' => [
			'eng' => 'Service Temporarily Unavailable',
			'esp' => 'Servicio no disponible.',
		],
		'6101' => [
			'eng' => 'Invalid request data; a required field is either missing or invalid',
			'esp' => 'Solicitud invalida, uno de los campos falta o es invalido.',
		],
		'6102' => [
			'eng' => 'Shipping region is not accepted by the merchant.',
			'esp' => 'La región de envio no es aceptada por el comercio.',
		],
		'6103' => [
			'eng' => 'The API key used in the operation is not authorized for the requested action; ensure that the API key corresponds to the call ID.',
			'esp' => 'El API key usado en la operación es invalido, asegúrese de proporcionar el API key correcto para el call ID.',
		],
		'6104' => [
			'eng' => 'Data access level (dataLevel)of the request is invalid.',
			'esp' => 'El nivel de acceso a los datos (dataLevel) de la solicitud es invalido.',
		],
		'6105' => [
			'eng' => 'x-pay-token header missing or invalid, or API key is missing or invalid.',
			'esp' => 'El encabezado x-pay-token falta o es invalido, o el API key falta o es invalido.',
		],
		'6106' => [
			'eng' => 'API key is not authorized to request dataLevel=FULL.',
			'esp' => 'El API key no está autorizado para la solicitud dataLevel=FULL.',
		],
		'6107' => [
			'eng' => 'Customer´s account is locked.',
			'esp' => 'La cuenta del cliente está bloqueada.',
		],
		'6108' => [
			'eng' => 'Customer´s account is inactive.',
			'esp' => 'La cuenta del cliente se encuentra inactiva.',
		],
		'6109' => [
			'eng' => 'Further operations on the card are not allowed.',
			'esp' => 'No se permiten más operaciones en la tarjeta.',
		],
		'6110' => [
			'eng' => 'API key or call ID not found, or data referenced by the API key or call ID is invalid or not available.',
			'esp' => 'API key o call ID no encontrados, o la referencia del dato por el API key o call ID son inválidos o no están disponibles.',
		],
		'6111' => [
			'eng' => 'Expired Call ID.',
			'esp' => 'El Call ID se encuentra expirado.',
		],
		'6112' => [
			'eng' => 'Merchant doesn´t have visa check out active.',
			'esp' => 'La afiliación no tiene el producto visa check out activo.',
		],
		'6113' => [
			'eng' => 'Merchant isn´t registered in visa check out.',
			'esp' => 'La afiliación no está registrada en visa checkout.',
		],
		'6114' => [
			'eng' => 'Transaction not valid.',
			'esp' => 'Transaccion no valida.',
		],
		
		
		// PROBLEMAS RELACIONADOS CON EL SERVIDOR DE CORREO

		'6301' => [
			'eng' => 'Attached element "" was not found in expected location.',
			'esp' => 'El elemento adjunto "" no existe en la ubicación esperada.',
		],
		'6302' => [
			'eng' => 'Attached element "" is not really a file.',
			'esp' => 'El elemento adjunto "" no es un archivo.',
		],
		'6303' => [
			'eng' => 'Attached element "" cannot be read.',
			'esp' => 'El elemento adjunto "" no puede ser leído.',
		],
		'6304' => [
			'eng' => 'Unable to send mail. Reason: "".',
			'esp' => 'Incapaz de enviar correo. Causa: "".',
		],


		// PROBLEMAS RELACIONADOS CON REPORTES DE CIERRE
		
		'6601' => [
			'eng' => 'Unable to initialize group capture report. Cause: ""',
			'esp' => 'Falla al inicializar reporte de cierre de lote. Causa: ""',
		],
		'6602' => [
			'eng' => 'Unable to create header in group capture report. Cause: ""',
			'esp' => 'Falla al crear encabezado de reporte de cierre de lote. Causa: ""',
		],
		'6603' => [
			'eng' => 'Unable to add row to group capture report. Cause: ""',
			'esp' => 'Falla al agregar línea al reporte de cierre de lote. Causa: ""',
		],
		'6604' => [
			'eng' => 'Unable to create group capture report file. Name: ""',
			'esp' => 'Falla al tratar de crear archivo de reporte de cierre de lote. Nombre: ""',
		],
		'6605' => [
			'eng' => 'Unable to initialize affiliation capture report. Cause: ""',
			'esp' => 'Falla al inicializar reporte de cierre de afiliación. Causa: ""',
		],
		'6606' => [
			'eng' => 'Unable to create header in affiliation capture report. Cause: ""',
			'esp' => 'Falla al crear encabezado de reporte de cierre de afiliación. Causa: ""',
		],
		'6607' => [
			'eng' => 'Unable to add row to affiliation capture report. Cause: ""',
			'esp' => 'Falla al agregar línea al reporte de cierre de afiliación. Causa: ""',
		],
		'6608' => [
			'eng' => 'Unable to create affiliation capture report file. Name: ""',
			'esp' => 'Falla al tratar de crear archivo de reporte de cierre de afiliación. Nombre: ""',
		],
		

		// PROBLEMAS RELACIONADOS CON CYBERSOURCE

		'6801' => [
			'eng' => 'Cybersource service is not available for this type of affiliation.',
			'esp' => 'El servicio Cybersource no está disponible para este tipo de afiliación.',
		],
		'6802' => [
			'eng' => 'The transaction received (Cybersource Id = "") has not been previously verified by Cybersource.',
			'esp' => 'La transaccion proporcionada (Id Cybersource = "") no ha sido validada previamente por Cybersource.',
		],
		'6803' => [
			'eng' => 'The transaction received (Cybersource Id = "") was previously rejected by Cybersource and cannot be processed.',
			'esp' => 'La transaccion proporcionada (Id Cybersource = "") fue rechazada por Cybersource y no puede ser procesada.',
		],
		'6804' => [
			'eng' => 'Unable to connect to BanorteCybersource service to validate the submitted transaction (Cybersource Id = "").',
			'esp' => 'No ha podido establecerse la conexión necesaria con el sistema BanorteCybersource para validar la transacción (Id Cybersource = "").',
		],


		// PROBLEMAS RELACIONADOS CON AMERICAN EXPRESS

		'6900' => [
			'eng' => 'There isn´t a fraudulency secure level: high, middle, there isn´t verification.',
			'esp' => 'No se tiene asignado un nivel de seguridad contra fraude (SIN VALIDACION, MEDIO, ALTO).',
		],
		'6901' => [
			'eng' => 'The fraudulency secure level "" isn´t valid.',
			'esp' => 'El nivel de seguridad contra fraudes "" no es valido.',
		],
		'6902' => [
			'eng' => 'The fields are necessary: ""',
			'esp' => 'Los siguientes datos deben ser proporcionados ""',
		],
		'6903' => [
			'eng' => 'There aren´t AAV, phone and email verification.',
			'esp' => 'No existen las validaciones AAV, Telefono y correo electrónico.',
		],
		'6904' => [
			'eng' => 'There isn´t a format valid for AAV, phone and email verification.',
			'esp' => 'Validaciones AAV, Telefono y Correo electronico tiene un formato incorrecto.',
		],
		'6905' => [
			'eng' => 'Values CID supplied for parameter Fraud Prevention Services is not valid.',
			'esp' => 'El valor CID proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido.',
		],
		'6906' => [
			'eng' => 'Values ZIP CODE, STREET ADDRESS, PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL, DIRECCION, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6907' => [
			'eng' => 'Values ZIP CODE, PHONE NUMBER, EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6908' => [
			'eng' => 'Values ZIP CODE, STREET ADDRESS and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL, DIRECCION y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6909' => [
			'eng' => 'Values ZIP CODE and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL, DIRECCION y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6910' => [
			'eng' => 'Values ZIP CODE, STREET ADDRESS and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL, DIRECCION y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6911' => [
			'eng' => 'Values ZIP CODE and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6912' => [
			'eng' => 'Values ZIP CODE, STREET ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CODIGO POSTAL y DIRECCION proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6913' => [
			'eng' => 'Value ZIP CODE supplied for parameter Fraud Prevention Services is not valid.',
			'esp' => 'El valor CODIGO POSTAL proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido.',
		],
		'6914' => [
			'eng' => 'Values STREET ADDRESS, PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores DIRECCION, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6915' => [
			'eng' => 'Values PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6916' => [
			'eng' => 'Values STREET ADDRESS and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores DIRECCION y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6917' => [
			'eng' => 'Value PHONE NUMBER supplied for parameter Fraud Prevention Services is not valid.',
			'esp' => 'El valor NUMERO TELEFONICO proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido.',
		],
		'6918' => [
			'eng' => 'Values EMAIL and STREET ADDRESS supplied for parameters Fraud Prevention Services are not valid.',
			'esp' => 'Los valores CORREO ELECTRONICO Y DIRECCION proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos.',
		],
		'6919' => [
			'eng' => 'Value EMAIL ADDRESS supplied for parameter Fraud Prevention Services is not valid.',
			'esp' => 'El valor CORREO ELECTRONICO proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido.',
		],
		'6920' => [
			'eng' => 'Value STREET ADDRESS supplied for parameter Fraud Prevention Services is not valid.',
			'esp' => 'El valor DIRECCION proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido.',
		],
		'6921' => [
			'eng' => 'Does not meet the fraud prevention configuration chosen by the Electronic Commerce.',
			'esp' => 'No cumple con la configuración de prevención de fraudes elegida por el Comercio Electrónico.',
		],
		

		// PROBLEMAS RELACIONADOS CON OPERACIONES DE CIFRADO O DESCIFRADO

		'7001' => [
			'eng' => 'Failure when trying to encrypt a text.',
			'esp' => 'Falla al intentar cifrar un texto.',
		],
		'7002' => [
			'eng' => 'Failure when trying to decrypt a text.',
			'esp' => 'Falla al intentar descifrar un texto.',
		],
		'7003' => [
			'eng' => 'Unable to generate a key for a device.',
			'esp' => 'Falla al intentar generar llave para dispositivo.',
		],
		'7004' => [
			'eng' => 'Unable to decypher key in database for device with id "".',
			'esp' => 'Falla al intentar descifrar llave en base de datos para el dispositivo con id "".',
		],
		'7005' => [
			'eng' => 'Unable to initialize HSM. Message = "".',
			'esp' => 'Incapaz de inicializar HSM. Mensaje = "".',
		],
		'7006' => [
			'eng' => 'Unable to retrieve key from the HSM.',
			'esp' => 'Falla al intentar obtener llave del HSM.',
		],
		'7007' => [
			'eng' => 'The HSM device is not currently active.',
			'esp' => 'El dispositivo HSM no se encuentra operativo.',
		],
		'7008' => [
			'eng' => 'Failure when trying to remove a key from the HSM.',
			'esp' => 'Falla al eliminar llave del HSM.',
		],
		'7009' => [
			'eng' => 'Failure when trying to add a key into the HSM.',
			'esp' => 'Falla al agregar llave al HSM.',
		],


		// PROBLEMAS RELACIONADOS CON 3D SECURE

		'7100' => [
			'eng' => 'The Transaction does not contain valid information.',
			'esp' => 'La transacción no contiene información válida.',
		],


		// PROBLEMAS MISCELANEOS INESPERADOS

		'9999' => [
			'eng' => 'Unexpected failure.',
			'esp' => 'Falla inesperada en aplicación.',
		],

	];

	public $codigo;

	public $numero_codigo;

	public function __construct($codigo)
	{
		$this->codigo = $codigo;

		$this->numero_codigo = self::removerPrefijo( $codigo ?? '' );
	}

    public function existe()
    {
        return array_key_exists($this->numero_codigo, self::$codigos_mensajes);
    }

    public function mensaje()
    {
        return $this->existe() ? self::$codigos_mensajes[$this->numero_codigo][self::IDIOMA_PREDETERMINADO] : null;
    }


	// Statics

	public static function removerPrefijo(string $codigo)
    {
        return trim( str_replace('PAYW-', '', $codigo) );
    }
}


/*

*** PROBLEMAS RELACIONADOS CON TLS

PAYW-0001
Platform does not support requested TLS algorithm.
El algoritmo definido para encriptar en TLS no está soportado en esta plataforma.

PAYW-0002
Unexpected error when trying to access local keystore
Falla inesperada al accesar almacén de llaves (keystore)

PAYW-0003
The keystore could not be found at the configured location
El almacén de llaves (keystore) especificado no existe en la ubicación configurada

PAYW-0004
The keystore is not valid or is corrupted
El almacén de llaves (keystore) configurado no es válido o está correcto.

PAYW-0005
Access to keystore is not allowed
El acceso al almacén de llaves (keystore) fue denegado por falta de permisos

PAYW-0006
General failure during TLS handshaking
Falla general de seguridad en manejo de socket TLS 



*** PROBLEMAS RELACIONADOS CONN SERVIDOR TCP

PAYW-0101
Socket server cannot be started
Falla al inicializar servidor de sockets 



*** PROBLEMAS RELACIONADOS CON CLIENTE TCP

PAYW-0201
Client was unable to create socket to connect to server xxx
Falla al intentar crear socket en cliente hacia servidor xxx

PAYW-0202
Unable to connect to server xxx
Incapaz de establecer conexión con servidor xxx

PAYW-0203
Connection to server xxx has been closed. Trying to reconnect
No se tiene conexión actualmente con el servidor xxx. Se intenta reconexión



*** PROBLEMAS RELACIONADOS CON MENSAJERIA ISO

PAYW-1001
Received ISO message does not meet the expected format
El mensaje ISO recibido no tiene el formato esperado

PAYW-1002
Invalid TPU in the received ISO message
El mensaje ISO recibido contiene una TPDU no válida

PAYW-1003
The bitmap in the received ISO message is not valid
El mensaje ISO recibido no tiene un mapa de bits consistente.

PAYW-1004
Received ISO message has an invalid suffix
El mensaje ISO recibido tiene un terminador no válido

PAYW-1005
Failure when trying to decode field xxx
Falla al decodificar el campo xxx

PAYW-1006
Failure when trying to encode xxx. Value\: ''yyy''
Falla al codificar el campo xxx. Valor\: ''yyy''

PAYW-1007
Field contents in the ISO message exceeds the maximum allowed
El contenido del campo excede el máximo permissible

PAYW-1008
Unexpected type for field xxx in the ISO message
El tipo del campo xxx no es del tipo esperado

PAYW-1009
Charset ISO-8859-1 is not supported in the current execution platform
El juego de caracteres ISO-8859-1 no está soportado en esta plataforma

PAYW-1010
Incomplete field xxx in the ISO message
El campo xxx está incomplete en el mensaje ISO

PAYW-1011
Invalid field xxx in the ISO message
El campo xxx no es válido

PAYW-1012
Variable length for field xxx exceeds value specified in the prefix
La longitud del campo variable xxx excede lo indicado en el prefijo

PAYW-1013
Field xxx has an invalid content
El contenido del campo xxx no es válido

PAYW-1014
POS Entry Mode (field 22) has an invalid value
El modo de entrada (campo 22) no es válido

PAYW-1015
Field xxx is required but was not included in the ISO message
El campo xxx es requerido y no fue incluido en el mensaje ISO

PAYW-1016
Statistical message does not have the expected format
El mensaje de estadísticos recibido no tiene el formato esperado

PAYW-1017
Unable to recognize transaction sent by device
No ha sido posible identificar el tipo de transacción enviada por el dispositivo

PAYW-1018
Information about Q6 promotion is not valid
La información de promoción Q6 es inválida 



*** PROBLEMAS RELACIONADOS CON INTERFAZ HTTP

PAYW-2001
Unexpected failure when processing command/transaction
Falla inesperada al intentar procesar transacción

PAYW-2002
Parameter 'xxx' cannot be provided for a manual transaction
El parámetro 'xxx' no puede incluirse en una transacción manual

PAYW-2003
Parameter 'xxx' cannot be provided for transaction with a swiped/inserted card
El parámetro 'xxx' no puede incluirse en una transacción con plástico presente

PAYW-2004
Parameter 'xxx' with value 'yyy' can only be provided for a transaction with a chip card
El parámetro 'xxx' con valor 'yyy' sólo es requerido en una transacción de chip

PAYW-2005
Parameter 'xxx' with value 'yyy' cannot be accepted for a manual transaction
El parámetro 'xxx' con valor 'yyy' no es compatible con una transacción manual

PAYW-2006
Parameter 'xxx' with value 'yyy' cannot be accepted for a swiped / inserted card
El parámetro 'xxx' con valor 'yyy' no es compatible con una transacción con plástico presente

PAYW-2007
Promotional transaction requires some missing fields
La información sobre la promoción en la transacción no está complete

PAYW-2008
Parameter 'xxx' with value 'yyy' specifies an expired date
El parámetro 'xxx' con valor ''yyy' corresponde a una fecha expirada

PAYW-2009
Command requires either 'REFERENCE' or 'CONTROL_NUMBER'
El comando requiere 'REFERENCIA' o 'NUMERO_CONTROL'

PAYW-2010
Required parameter 'CMD_TRANS' was not supplied
No se especificó el parámetro requerido 'CMD_TRANS'

PAYW-2011
Requested Command/transaction 'xxx' is not valid or not supported
El comando/transacción 'xxx' no es válido(a) o no está soportado(a)

PAYW-2012
Value 'yyy' supplied for parameter 'xxx' is not valid
El valor 'yyy' suministrado para el parámetro 'xxx' es inválido

PAYW-2013
Value 'yyy' supplied for parameter 'xxx' exceeds maximum allowed length\: zzz
El valor 'yyy' suministrado para el parámetro 'xxx' excede la longitud máxima permitida\: zzz

PAYW-2014
Parameter 'xxx' cannot be null
El parámetro 'xxx' no puede ser nulo

PAYW-2015
No response received for the command / transaction
No hubo respuesta para el comando / transacción

PAYW-2016
Parameters 'XID' y 'CAVV' are required for this type of transaction
Los parámetros 'XID' y 'CAVV' son obligatorios para este tipo de transacción

PAYW-2017
Failure while trying to decypher transaction data
Falla al intentar descifrar campos de transacción

PAYW-2018
The following parameter is required to process the request: ''
El siguiente parámetro es requerido para procesar el requerimiento: ''

PAYW-2019
The key needed to decrypt data from this device has not been loaded or is not available
La llave necesaria para procesar datos cifrados no ha sido cargada para este dispositivo o no está disponible

PAYW-2020
Unable to decrypt data received at the 'INTERREDES' channel
Falla al intentar descifrar requerimiento enviado al canal INTERREDES

PAYW-2021
Parameter '' cannot accept negative values
El parámetro '' no puede aceptar valores negativos

PAYW-2022
Response url not valid
Respuesta url no válida

PAYW-2023
Control number not secure
El numero de control no es seguro

PAYW-2024
Response url not valid
Respuesta url no válida 



*** PROBLEMAS RELACIONADOS CON COMANDOS Y TRANSACCIONES

PAYW-3001
Unable to execute command/transaction; please retry later
Incapaz de realizar operación. Por favor intente más tarde

PAYW-3002
Invalid Affiliation / User
La afiliación o el usuario proporcionados no existen

PAYW-3003
Invalid User / Password
Usuario o contraseña inválidos

PAYW-3004
Affiliation xxx is currently inactive
La afiliación xxx no se encuentra active

PAYW-3005
Client xxx is currently inactive
El cliente xxx no se encuentra active

PAYW-3006
User xxx is currently inactive
El cliente xxx no se encuentra active

PAYW-3007
User xxx is not allowed to execute commands / transactions
El usuario xxx no tiene el permiso necesario para ejecutar comandos/transacciones

PAYW-3008
Terminal xxx does not exist for this affiliation
La terminal xxx no existe para esta afiliación

PAYW-3009
Terminal xxx is currently inactive
La terminal xxx no se encuentra active

PAYW-3010
Card brand / terminal do not allow this type of transaction
Transacción no permitida para esta terminal y marca de tarjeta

PAYW-3011
Command xxx is not currently supported
El comando xxx no está soportado actualmente

PAYW-3012
Referred transaction xxx does not exist
La transacción referenciada xxx no existe

PAYW-3013
Referred transaction xxx has been previously cancelled
La transacción referenciada xxx ha sido cancelada previamente.

PAYW-3014
Rejected: The total amount for transaction xxx has been already refunded
Rechazada: El 100% del importe de la transacción referenciada xxx ya ha sido devuelto

PAYW-3015
Rejected: Partial refunds have been already applied to referred transaction xxx
Rechazada: La transacción referenciada xxx ya tiene devoluciones parciales aplicadas

PAYW-3016
Illegal to execute a refund on the referred transaction xxx
La transacción referenciada xxx no permite devoluciones

PAYW-3017
Refund requires the referred transaction xxx to be closed first (still open)
No es posible efectuar una devolución sobre la transacción xxx, la cual no ha sido cerrada

PAYW-3018
Amount requested in the refund xxx exceeds the maximum allowed: yyy
El importe de la devolución por xxx excede el máximo disponible: yyy

PAYW-3019
Not allowed to close a reauthorization; please use the original preauthorization
No se admite el cierre de reautorizaciones; utilice la preautorización original.

PAYW-3020
Postauthorizations are only valid for open preauthorizations
Sólo se permiten postautorizaciones para preautorizaciones abiertas.

PAYW-3021
Postauthorization's amount of xxx exceeds the maximum allowed: yyy
El monto de la postautorización por xxx excede el máximo disponible: yyy

PAYW-3022
Reauthorizations are only valid for open preauthorizations
Sólo se permiten reautorizaciones parapreautorizaciones abiertas

PAYW-3023
Reauthorizations are not allowed for this application type: xxx
El tipo de aplicación xxx no permite reautorizaciones

PAYW-3024
Illegal to execute a cancellation on the referred transaction xxx
La transacción referenciada xxx no permite cancelaciones

PAYW-3025
Cancellation requires the referred transaction xxx to be closed first (still open)
No es posible efectuar una cancelación sobre la transacción xxx, la cual no ha sido cerrada

PAYW-3026
Not allowed to execute cancellations
No tiene el permiso para ejecutar una cancelación

PAYW-3027
Not allowed to execute a cashback
No tiene el permiso para ejecutar una transacción de cashback

PAYW-3028
Not allowed to execute a credit
La transacción de crédito directo no está habilitada

PAYW-3029
Not allowed to execute a refund
No se tiene el permiso necesario para ejecutar una transacción de Devolución

PAYW-3030
Unrestricted or late refunds are not allowed
No se tiene el permiso necesario para ejecutar una transacción de Devolución

PAYW-3031
Not allowed to execute transactions including promotions
No se tiene el permiso necesario para efectuar una transacción con promoción

PAYW-3032
Not allowed to execute QPS transactions
No se tiene el permiso necesario para ejecutar transacciones QPS

PAYW-3033
Not allowed to execute a forced authorization
No se tiene el permiso necesario para realizar una venta forzada

PAYW-3034
Amount exceeds the maximum allowed for a QPS transaction
El monto indicado en la transacción QPS excede el máximo permissible

PAYW-3035
Affiliation requires a valid terminal number to be supplied
La afiliación requiere que se proporcione una terminal válida

PAYW-3036
Default terminal does not exist in the database
La terminal por defecto no ha sido creada en la base de datos

PAYW-3037
Card type xxx is not currently Supported
No hay soporte para las tarjetas de marca xxx

PAYW-3038
Authorizer xxx is not currently supported
No hay soporte para el autorizador xxx

PAYW-3039
Control number xxx has been already used for a previous transaction
El No. de Control xxx ya existe para una transacción anterior

PAYW-3040
Transactions with amount zero are not valid
No se permite monto cero en una transacción

PAYW-3041
FALLBACK transactions are not allowed
Las transacciones FALLBACK no están permitidas

PAYW-3042
The 3DSecure eCommerce indicator (ECI) received for this transaction is not allowed
El indicador de 3DSecure (ECI) recibido para esta transacción no está permitido

PAYW-3043
Previous operation required by this transacction could not be executed
La operación previa requerida para ejecutar esta transacción no tuvo éxito

PAYW-3044
Previous operation required by this transacction was declined by authorizer
La operación previa requerida para ejecutar esta transacción fue declinada por el autorizador.

PAYW-3045
No response received for previous operation required by this transaction
La operación previa requerida para ejecutar esta transacción no tuvo respuesta

PAYW-3046
The security code is required and was not supplied
El código de seguridad es requerido y no fue proporcionado

PAYW-3047
Transaction entry mode is not allowed for affiliation type: xxx
El modo de entrada de la transacción no es compatible con el tipo de afiliacion: xxx

PAYW-3048
No manual entry mode for transactions is allowed
No se tiene el permiso necesario para ejecutar transacciones digitadas o manuales.

PAYW-3049
Referred transaction xxx has been previously cancelled
La transacción referenciada xxx ya había sido reversada

PAYW-3050
The referred transaction cannot be reversed
La transacción referenciada no admite reversas

PAYW-3051
Referred transaction xxx had not been approved
La transacción referenciada xxx se encuentra en estado de suspensión

PAYW-3052
Referred transaction xxx is currently locked
La transacción referenciada xxx se encuentra en estado de suspensión

PAYW-3053
Cashback is only allowed for transactions with card present (CHIP / MAGSTRIPE)
La transacción de cashback sólo está permitida con plástico presente (CHIP / BANDA)

PAYW-3054
No transaction was found for the affiliation / terminal supplied
No se encontró ninguna transacción para la afiliación/terminal suministrados

PAYW-3055
Referred transaction exists, but it was not generated by the supplied terminal
La transacción referenciada existe, pero no fue generada por la terminal proporcionada

PAYW-3056
Referred transaction exists, but it does not belong to the supplied affiliation
La transacción referenciada existe, pero no pertenece a la afiliación proporcionada

PAYW-3057
Settlement for group xxx is already running; cannot be executed concurrently more than once
El cierre del lote xxx ya está en proceso; no puede ejecutarse concurrentemente más de una vez

PAYW-3058
Settlement for this affiliation is already running; cannot be executed concurrently more than once
El cierre masivo para esta afiliación ya está en proceso; no puede ejecutarse concurrentemente más de una vez

PAYW-3059
No transaction mode was sent (if it is an ISO
transaction, please make sure that the affiliation is of type TPV)
No se especificó modo de la transacción (si es ISO
verifique que la afiliación sea de tipo TPV).

PAYW-3060
The affiliation is of type TPV. It is not valid to provide the MODE parameter
La afiliación es de tipo TPV;no es válido proporcionar el parámetro MODO

PAYW-3061
The affiliation has been configured as aggregator but the format indicator is null
La afiliación ha sido configurada como agregador pero el indicador de formato es nulo

PAYW-3062
The affiliation has been configured as aggregator; missing associated merchant is required (SUB_MERCHANT)
La afiliación es un agregador; se requiere obligatoriamente el nombre del comercio asociado (SUB_AFILIACION)

PAYW-3063
This transaction is not acceptable under mobile
payment mode
Esta transacción no es aceptable con pago móvil

PAYW-3064
Not allowed to execute mobile payment transactions
No se tiene el permiso necesario para ejecutar
transacciones de pago móvil

PAYW-3065
This card cannot be used in mobile payment transactions
Esta tarjeta no está autorizada para realizar transacciones de pago móvil

PAYW-3066
Mobile payment transactions can only be manually entered
La transacciones de pago móvil únicamente pueden ser digitadas

PAYW-3067
Plan type xxx is not valid
El valor del tipo de plan suministrado xxx es inválido

PAYW-3068
Promotion is not valid or not supported
La promoción proporcionada es inválida o no está soportada

PAYW-3069
Plan type xxx conflicts with other data in the promotion
El tipo de plan xxx es inconsistente con la promoción proporcionada

PAYW-3070
This transaction cannot be sent in test mode, since the referred transaction was sent in production mode
No se admite esta transacción en modo de prueba, ya que la transacción referenciada fue enviada en modo de producción

PAYW-3071
This transaction cannot be sent in production mode, since the referred
transaction was sent in test mode
No se admite esta transacción en modo de producción, ya que la transacción referenciada fue enviada en modo de prueba

PAYW-3072
The requested cashback amount is below the minimum required
El monto a disponer en esta transacción está por debajo del mínimo requerido

PAYW-3073
The requested cashback amount exceeds the maximum allowed
El monto a disponer en esta transacción excede el máximo autorizado

PAYW-3074
The maximum number of cashback transactions allowed per day has been already reached
El número máximo de transacciones cashback que pueden ejecutarse en un día ha sido ya alcanzado

PAYW-3075
Transacion rejected since it would cause the maximum allowed daily cashback disposal to be exceeded
Transacción rechazada ya que se excedería el monto máximo diario autorizado de disposición cashback

PAYW-3076
Reauthorizations on a previous EMV transaction are not acceptable; a new preauthorization is required
No se admiten reautorizaciones de una transacción previa de tipo EMV; se requiere nueva lectura de plástico

PAYW-3077
Amount exceeds maximum limit allowed for a manual transaction
El monto excede el tope máximo permisible para una transacción digitada

PAYW-3078
One or more elements required by the referred transaction are empty
Uno o más elementos requeridos por la transacción referenciada no fueron proporcionados

PAYW-3079
Selector validation for device serial number '' failed
Falla al validar el selector enviado para el pinpad con número de serie ''

PAYW-3080
Unable to cypher master key for device with serial number ''
Falla al intentar cifrar la llave que se enviará al pinpad con número de serie ''

PAYW-3081
No terminal was found having the provided serial number ''
No se encontró una terminal válida para el número de serie proporcionado ''

PAYW-3082
The device with serial number '' has not been assigned a key
El dispositivo con número de serie '' no cuenta con una llave asignada

PAYW-3083
Unable to retrieve exception bins for the requesting customer
Falla al obtener lista de bines de excepción para el cliente solicitante

PAYW-3084
Failure when trying to cipher list of exception bins requested by device with serial number ''
Falla al intentar cifrar lista de bines de excepción que se enviará al dispositivo con número de serie ''

PAYW-3085
Referred transaction '' had not been approved
La transacción referenciada '' no había sido aprobada

PAYW-3086
Transacion rejected. Use chip reader slot
Transacción rechazada, utilice lector chip

PAYW-3087
Referred transaction {0} does not exist
La transacci\u00f3n referenciada {0} no existe

PAYW-3088
Exceeded the days of the closing time limit
Excedi\u00f3 los d\u00EDas del tiempo l\u00EDmite de cierre



*** PROBLEMAS RELACIONADOS CON AUTORIZADORES

PAYW-4001
Configuration for connector to authorizer xxx does not
include any channel
El conector hacia el autorizador xxx no tiene canales configurados

PAYW-4002
Authorizer xxx is not currently available
El autorizador xxx no está Disponible

PAYW-4003
Transaction xxx is not supported for authorizer yyy
La transacción xxx no está soportada para el autorizador yyy

PAYW-4004
Timeout for transaction xxx; response not received within the maximum amount of time
El tiempo máximo de espera para la transacción xxx ha sido excedido

PAYW-4005
Authorizer requires track 1 for this transaction
El track 1 es requerido por el autorizador para esta transacción

PAYW-4006
There is no information in the database about the specified affiliation/terminal for the authorizer xxx
No hay información en la base de datos sobreafiliación/terminal para enviar hacia el autorizador xxx.

PAYW-4007
There is no terminal id for the authorizer xxx
No existe no. de terminal para enviar hacia el autorizador xxx

PAYW-4008
There is no merchant id for the authorizer xxx
No existe no. de afiliación para enviar hacia el autorizador xxx

PAYW-4009
Invalid type plan ('xxx') for a promotion
El valor para el tipo de plan ('xxx') no es válido.

PAYW-4010
Plan type value ('xxx') mismatches other parameters in the promotion
El valor para el tipo de plan ('xxx') no es congruente con el resto de parámetros de la promoción.

PAYW-4011
Promotion must include initial deferment and/or
payments number
La promoción debe incluir diferimiento inicial y/o número de pagos

PAYW-4012
Failure to decode token xxx: Value ‘yyy’ for subfield zzz is not aceptable according to the specification
La información de EMV suministrada no es válida o está incompleta.

PAYW-4013
Failure to decode token xxx: Value ‘yyy’ for subfield zzz is not aceptable according to the specification
Falla al decodificar token xxx: El valor ‘yyy’ para el subcampo zzz no es aceptable de acuerdo a especificación.

PAYW-4014
Supplied EMV data does not contain element '' and it is required
El elemento '' no está presente en la información EMV suministrada y es requerido

PAYW-4015
Element '' supplied as part of EMV data is invalid
El elemento '' suministrado en la información EMV es inválido

PAYW-4016
Transaction '' is too old and will not be sent to the authorizer
La transacción '' fue recibida hace ya demasiado tiempo y no se enviará al autorizador

PAYW-4017
Inconsistent card number
Número de tarjeta inconsistente

PAYW-4018
Timeout for transaction ''; response not received within the maximum amount of time, it has reversal ''
El tiempo máximo de espera para la transacción '' ha sido excedido, reversa generada '' 



*** PROBLEMAS RELACIONADOS CON EL CONECTOR PROSA

PAYW-4501
Falla al decodificar token '': el valor '' para el subcampo '' no es aceptable de acuerdo a especificación
Falla al decodificar token '': el valor '' para el subcampo '' no es aceptable de acuerdo a especificaci\u00f3n 



*** PROBLEMAS RELACIONADOS CON BASE DE DATOS

PAYW-5000
Failure when trying to execute operation in the database\: ''
Falla al intentar ejecutar la siguiente operación en base de datos\: ''

PAYW-5001
Failure when trying to execute operation in the database: xxx.
Falla al intentar ejecutar la siguiente operación en base de datos: xxx.



*** PROBLEMAS RELACIONADOS CON REGLAS DE PREVENCION DE FRAUDE

PAYW-6001
Transaction has been rejected due to application of rule xxx assigned to this affiliation.
Transacción rechazada por aplicación de la regla xxx asignada para esta afiliación.

PAYW-6002
Rule xxx assigned to this affiliation contains errors in its formula
Transacción rechazada por error en la fórmula definida para la regla xxx asignada para esta afiliación

PAYW-6003
Failure when executing formula defined for rule xxx assigned to this affiliation.
Transacción rechazada por falla al procesar la fórmula definida para la regla xxx asignada para esta afiliación.

PAYW-6004
Class defined for rule xxx has not been implemented yet.
La clase definida para la regla xxx no ha sido implementada.

PAYW-6005
Unable to créate executor for rule xxx.
Falla al instanciar clase definida para la regla xxx.

PAYW-6006
Invalid search condition for rule xxx
Condición inválida de búsqueda en regla xxx.

PAYW-6007
The search table used in formula for rule xxx does not exist.
La tala de búsqueda proporcionada en la fórmula para la regla xxx no existe.

PAYW-6008
The Excel file needed by formula defined for rule xxx does not exist.
El archivo Excel requerido por la fórmula definida para la regla xxx no existe.

PAYW-6009
Failure when trying to access the }Excel file needed by formula defined for rule xxx.
Falla al intentar accesar el archivo Excel requerido por la fórmula definida para la regla xxx.

PAYW-6010
Failure when querying table needed by rule xxx.
Falla al ejecutar búsqueda en tabla requerida por la regla xxx.

PAYW-6011
Unable to load Excel driver required to execute rule xxx.
Incapaz de cargar driver Excel para ejecutar regla xxx.

PAYW-6012
="excep.regla.comercio" value="
Variable configurable por el Comercio. 



*** PROBLEMAS RELACIONADOS CON EL SERVICIO VISA CHECK OUT

PAYW-6100
Service Temporarily Unavailable
Servicio no disponible

PAYW-6101
Invalid request data; a required field is either missing or invalid
Solicitud invalida, uno de los campos falta o es invalido

PAYW-6102
shipping region is not accepted by the merchant
La región de envio no es aceptada por el comercio.

PAYW-6103
The API key used in the operation is not authorized for the requested action; ensure that the API key corresponds to the call ID.
El API key usado en la operación es invalido, asegúrese de proporcionar el API key correcto para el call ID

PAYW-6104
Data access level (dataLevel)of the request is invalid
El nivel de acceso a los datos (dataLevel) de la solicitud es invalido

PAYW-6105
x-pay-token header missing or invalid, or API key is missing or invalid
El encabezado x-pay-token falta o es invalido, o el API key falta o es invalido

PAYW-6106
API key is not authorized to request dataLevel=FULL
El API key no está autorizado para la solicitud dataLevel=FULL

PAYW-6107
Customer's account is locked
La cuenta del cliente está bloqueada

PAYW-6108
Customer's account is inactive
La cuenta del cliente se encuentra inactiva

PAYW-6109
Further operations on the card are not allowed
No se permiten más operaciones en la tarjeta

PAYW-6110
API key or call ID not found, or data referenced by the API key or call ID is invalid or not available
API key o call ID no encontrados, o la referencia del dato por el API key o call ID son inválidos o no están disponibles

PAYW-6111
Expired Call ID
El Call ID se encuentra expirado

PAYW-6112
Merchant doesn't have visa check out active
La afiliación no tiene el producto visa check out activo

PAYW-6113
Merchant isn't registered in visa check out
La afiliación no está registrada en visa checkout

PAYW-6114
Transaction not valid
Transaccion no valida



*** PROBLEMAS RELACIONADOS CON EL SERVIDOR DE CORREO

PAYW-6301
Attached element '' was not found in expected location
El elemento adjunto '' no existe en la ubicación esperada

PAYW-6302
Attached element '' is not really a file
El elemento adjunto '' no es un archivo

PAYW-6303
Attached element '' cannot be read
El elemento adjunto '' no puede ser leído

PAYW-6304
Unable to send mail. Reason: ''
Incapaz de enviar correo. Causa: ''



*** PROBLEMAS RELACIONADOS CON REPORTES DE CIERRE
PAYW-6601
Unable to initialize group capture report. Cause: ''
Falla al inicializar reporte de cierre de lote. Causa: ''

PAYW-6602
Unable to create header in group capture report. Cause: ''
Falla al crear encabezado de reporte de cierre de lote. Causa: ''

PAYW-6603
Unable to add row to group capture report. Cause: ''
Falla al agregar línea al reporte de cierre de lote. Causa: ''

PAYW-6604
Unable to create group capture report file. Name: ''
Falla al tratar de crear archivo de reporte de cierre de lote. Nombre: ''

PAYW-6605
Unable to initialize affiliation capture report. Cause: ''
Falla al inicializar reporte de cierre de afiliación. Causa: ''

PAYW-6606
Unable to create header in affiliation capture report. Cause: ''
Falla al crear encabezado de reporte de cierre de afiliación. Causa: ''

PAYW-6607
Unable to add row to affiliation capture report. Cause: ''
Falla al agregar línea al reporte de cierre de afiliación. Causa: ''

PAYW-6608
Unable to create affiliation capture report file. Name: ''
Falla al tratar de crear archivo de reporte de cierre de afiliación. Nombre: '' 



*** PROBLEMAS RELACIONADOS CON CYBERSOURCE

PAYW-6801
Cybersource service is not available for this type of affiliation
El servicio Cybersource no está disponible para este tipo de afiliación

PAYW-6802
The transaction received (Cybersource Id = '') has not been previously verified by Cybersource
La transaccion proporcionada (Id Cybersource = '') no ha sido validada previamente por Cybersource

PAYW-6803
The transaction received (Cybersource Id = '') was previously rejected by Cybersource and cannot be processed
La transaccion proporcionada (Id Cybersource = '') fue rechazada por Cybersource y no puede ser procesada

PAYW-6804
Unable to connect to BanorteCybersource service to validate the submitted transaction (Cybersource Id = '')
No ha podido establecerse la conexión necesaria con el sistema BanorteCybersource para validar la transacción (Id Cybersource = '') 



*** PROBLEMAS RELACIONADOS CON AMERICAN EXPRESS

PAYW-6900
There isn't a fraudulency secure level: high, middle, there isn't verification
No se tiene asignado un nivel de seguridad contra fraude (SIN VALIDACION, MEDIO, ALTO)

PAYW-6901
The fraudulency secure level '' isn't valid
El nivel de seguridad contra fraudes '' no es valido

PAYW-6902
The fields are necessary: ''
Los siguientes datos deben ser proporcionados ''

PAYW-6903
There aren't AAV, phone and email verification
No existen las validaciones AAV, Telefono y Correo electronico

PAYW-6904
There isn't a format valid for AAV, phone and email verification
Validaciones AAV, Telefono y Correo electronico tiene un formato incorrecto

PAYW-6905
Values CID supplied for parameter Fraud Prevention Services is not valid
El valor CID proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido

PAYW-6906
Values ZIP CODE, STREET ADDRESS, PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL, DIRECCION, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6907
Values ZIP CODE, PHONE NUMBER, EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6908
Values ZIP CODE, STREET ADDRESS and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL, DIRECCION y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6909
Values ZIP CODE and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6910
Values ZIP CODE, STREET ADDRESS and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL, DIRECCION y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6911
Values ZIP CODE and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6912
Values ZIP CODE, STREET ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CODIGO POSTAL y DIRECCION proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6913
Value ZIP CODE supplied for parameter Fraud Prevention Services is not valid
El valor CODIGO POSTAL proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido

PAYW-6914
Values STREET ADDRESS, PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores DIRECCION, NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6915
Values PHONE NUMBER and EMAIL ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores NUMERO TELEFONICO y CORREO ELECTRONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6916
Values STREET ADDRESS and PHONE NUMBER supplied for parameters Fraud Prevention Services are not valid
Los valores DIRECCION y NUMERO TELEFONICO proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6917
Value PHONE NUMBER supplied for parameter Fraud Prevention Services is not valid
El valor NUMERO TELEFONICO proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido

PAYW-6918
Values EMAIL and STREET ADDRESS supplied for parameters Fraud Prevention Services are not valid
Los valores CORREO ELECTRONICO Y DIRECCION proporcionados para el parametro Servicio de Prevencion de Fraudes no son validos

PAYW-6919
Value EMAIL ADDRESS supplied for parameter Fraud Prevention Services is not valid
El valor CORREO ELECTRONICO proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido

PAYW-6920
Value STREET ADDRESS supplied for parameter Fraud Prevention Services is not valid
El valor DIRECCION proporcionado para el parametro Servicio de Prevencion de Fraudes no es valido

PAYW-6921
Does not meet the fraud prevention configuration chosen by the Electronic Commerce
No cumple con la configuración de prevención de fraudes elegida por el Comercio Electrónico 



*** PROBLEMAS RELACIONADOS CON OPERACIONES DE CIFRADO O DESCIFRADO

PAYW-7001
Failure when trying to encrypt a text
Falla al intentar cifrar un texto

PAYW-7002
Failure when trying to decrypt a text
Falla al intentar descifrar un texto

PAYW-7003
Unable to generate a key for a device
Falla al intentar generar llave para dispositivo

PAYW-7004
Unable to decypher key in database for device with id ''
Falla al intentar descifrar llave en base de datos para el dispositivo con id ''

PAYW-7005
Unable to initialize HSM. Message = ''
Incapaz de inicializar HSM. Mensaje = ''

PAYW-7006
Unable to retrieve key from the HSM
Falla al intentar obtener llave del HSM

PAYW-7007
The HSM device is not currently active
El dispositivo HSM no se encuentra operativo

PAYW-7008
Failure when trying to remove a key from the HSM
Falla al eliminar llave del HSM

PAYW-7009
Failure when trying to add a key into the HSM
Falla al agregar llave al HSM 



*** PROBLEMAS RELACIONADOS CON 3D SECURE

PAYW-7100
The Transaction does not contain valid information.
La transacción no contiene información válida.



*** PROBLEMAS MISCELANEOS INESPERADOS

PAYW-9999
Unexpected failure
Falla inesperada en aplicación.

*/

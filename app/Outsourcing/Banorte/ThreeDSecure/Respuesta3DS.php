<?php

namespace App\Outsourcing\Banorte\ThreeDSecure;

use Illuminate\Http\Request;

/**
 * ManualDelIntegracion_3DSecure2.0_v1.2: pag.9 Variables retorno
 * 
 * Respuestas del sistema 3D Secure Bancario
 */
class Respuesta3DS
{
    public $estatus;

    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->estatus = new CodigoEstatus3DS( $request->get('Estatus', '0') );
    }

    /**
     * ManualDelIntegracion_3DSecure2.0_v1.2: pag.9 - Nota: XID, CAVV
     * 
     * Criptogramas
     * 
     * XID: Solo VISA, no retorna para MasterCard
     * CAVV: Para VISA y MasterCard
     */
    public function __get($name)
    {
        return $this->request->get( strtoupper($name) );
    }

    public function existe()
    {
        return $this->request->has('ECI') &&
                $this->request->has('Estatus') &&
                $this->request->has('REFERENCIA3D');
    }
}

/**
 * 
 * Ejemplo: Aprobado
 * {
 *      "ECI":"05", string(2)
 *      "XID":"00000101365751292473927106575110BD95C29A", string(40)
 *      "CAVV":"00000101365751292473927106575110BD95C29A", string(40)
 *      "Estatus":"200", string(3)
 *      "REFERENCIA3D":"W03084414158503 string(15)
 * "}
 * 
 * Ejemplo: No aprobado
 * {
 *      "ECI":"07", string(2)
 *      "Estatus":"423", string(3)
 *      "REFERENCIA3D":"W15230308153428" string(15)
 * }
 * 
 */

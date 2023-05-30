<?php

namespace App\Models;

use App\Models\Factura\CalcularImporteInterface;
use App\Models\Features\AyudasTabla;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model implements CalcularImporteInterface
{
    use AyudasTabla;

    protected $table = 'pag_con';


    // Attributes

    public function getNumeroAttribute()
    {
        return $this->convenio;
    }

    public function getPagoAttribute()
    {
        return $this->pago_act;
    }

    
    // Scopes

    public function scopeWhereNumero($query, string $numero_convenio_valido)
    {
        return $query->where('convenio', $numero_convenio_valido);
    }
    

    // Relationships

    public function factura()
    {
        return $this->hasOne(Factura::class, 'REZAGO_MAN', 'convenio');
    }


    // Interfaces

    /**
     * PROCESO PARA EL CALCULO DEL CONVENIO PARA EL IMPORTE(ADEUDO) ***
     * 
     * 1) Valida si la factura tiene un número de convenio válido.
     * Un número de convenio NO VÁLIDO tiene valor de cero(0) ó nulo(NULL).
     * Evitamos una consulta a MySQL para mejor rendimiento.
     * 
     * 2) La longitud de un número de convenio debe ser de seis(6) dígitos.
     * Existen números de convenio mayores a cero(0) PERO con longitud menor de seis(6) dígitos,
     * por lo cual se rellena de ceros(0) a izquierda para completar la longitud
     * con la función str_pad(). 
     * 
     *      IMPORTANTE tener la longitud correcta para buscar la tabla de convenios, 
     *      ya que en la tabla de Facturas puede tener número de convenio con una longitud diferente.
     * 
     *      EJEMPLO: Factura(456) y Convenio(000456) longitudes diferentes mismo convenios.
     * 
     * 3) Buscar el número de convenio para realizar los cálculos del importe, 
     * si no existe retorna nulo(NULL).
     * 
     * 4) Proceso del cálculo de importe dependiente del convenio:
     *      
     *      PRIMERA VERSION
     *      - Suma los pagos para obtener el convenio total.
     *      - Suma el pago actual al adeudo de la factura.
     *      - Resta a la suma del adeudo de la factura el convenio total.
     * 
     *      SEGUNDA VERSION: ~ ALTERA EL ADEUDO PARA SUMAR EL PAGO ACTUAL ~
     *      - Suma los pagos para obtener el convenio total.
     *      - Resta el convenio total al adeudo de la factura.
     *      - Suma el pago actual al resultado de la resta del adeudo y convenio.
     * 
     *      TERCERA VERSION: ~ ALTERA EL CONVENIO PARA RESTAR AL ADEUDO ~
     *      - Suma los pagos para obtener el convenio total.
     *      - Resta del convenio total el pago actual.
     *      - Resta del adeudo de la factura el resultado de la resta del convenio total y pago total.
     * 
     *      CUARTA VERSIO: ~ RETORNA EL RESULTADO DE LA RESTA DE CONVENIO TOTAL Y PAGO ACTUAL CON SIMBOLO "-" PARA RESTAR POSTERIORMENTE A IMPORTE(ADEUDO) ~
     *      - Suma los pagos para obtener el convenio total.
     *      - Resta del convenio total el pago actual.
     *      - Retorna el resultado del convenio total y pago actual con simbolo menos"-", para restar al importe.
     * 
     *      Ejemplo:
     *      $convenio_total = 800 (4 pagos actuales de 200)
     *      $pago_acutal = 200
     *      $adeudo = 1000
     * 
     *      PRIMERA VERSION
     *      ($adeudo:1000 - $pago_actual:200 = $resultado:1200) - $convenio_total:800 = $total:400
     * 
     *      SEGUNDA VERSION
     *      ($adeudo:1000 - $convenio_total:800 = $resultado:200) + $pago_actual:200 = $total:400
     * 
     *      TERCERA VERSION
     *      $adeudo:1000 - ($convenio_total:800 - $pago_actual:200 = $resultado:600) = $total:400
     * 
     *      CUARTA VERSION
     *      $convenio_total:800 - $pago_actual:200 = $resultado: -600
     * 
     * @return null || decimal
     */
    public static function calcularImporte(Factura $factura)
    {
        // 1:
        if( $factura->numero_convenio < 1 )
            return;

        // 2:
        $numero_convenio_valido = str_pad($factura->numero_convenio, 6, 0, STR_PAD_LEFT);
        $convenios = self::whereNumero($numero_convenio_valido)->orderBy('pago_act', 'asc')->get();
        
        // 3:
        if( $convenios->isEmpty() )
            return;

        // 4: CUARTA VERSION
        $factura->agregarConceptoConvenio('pagos', $convenios->implode('pago', ', '));
        $factura->agregarConceptoConvenio('pago', $convenios->first()->pago);
        $factura->agregarConceptoConvenio('total', $convenios->sum('pago'));

        return sprintf('-%s', ($convenios->sum('pago') - $convenios->first()->pago));
    }
}

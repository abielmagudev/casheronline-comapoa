<?php

namespace App\Models\Factura;

use App\Models\Bonificacion;
use App\Models\Convenio;
use App\Models\HistorialBonificacion;
use App\Models\HistorialPago;
use App\Models\Medidor;
use App\Models\Pagare;
use App\Models\PagoDiario;
use App\Models\Transaccion;

trait ImporteSaldoTrait
{
    // Properties
    
    protected $conceptos = [];

    protected $importe_cache = null;

    protected $saldo_cache = null;


    // Attributes

    public function getDesgloseAttribute()
    {
        return json_encode($this->conceptos);
    }


    // Convenio

    public function agregarConceptoConvenio(string $llave, $valor)
    {
        $this->conceptos['convenio'][$llave] = $valor;
    }


    // Importe ***********************************************************************************

    /**
     * IMPORTE TRANSACCION
     * 
     * Importe para transacción es el que se envia a 3D Secure y se almacena en Transacción una vez 
     * que la respuesta de 3D Secure es correcta(Código=200)
     * 
     * 1) Verifica que la aplicación esta en modo debug, es decir, modo pruebas, si es asi,
     * los importes para la transacción serán de $1.00 para evitar pagos mayores a este.
     * 
     * 2) Si la aplicación esta en modo producción(debug=false), revisa que haya abonos parciales como
     * las pruebas de $1.00 peso, para considerarlos al momento de la transacción real.
     * 
     * 3) Si no hay abonos, el importe de la transacción será del importe calculado sin abonos
     */
    public function getImporteTransaccionAttribute()
    {
        if( config('app.debug') )
            return 1;

        return $this->tieneAbonos() ? $this->importe_restante : $this->importe_calculado;
    }

    /**
     * IMPORTE CALCULADO
     * 
     * El importe calculado es el cálculo real del importe sin abonos ni pagos de tarjeta bancarias.
     * Es la suma del consumo y sus conceptos derivados como medidores, etcétera.
     * 
     * 1) Revisa que se haya calculado el importe($importe_cache), en caso de que no,
     * Ejecuta la función de calcularImporte() y guardarlo en caché.
     * 
     * 2) Retorna la caché del importe cálculado
     */
    public function getImporteCalculadoAttribute()
    {
        if(! $this->tieneImporteCalculado() )
            $this->calcularImporte();

        return $this->importe_cache;
    }

    /**
     * Valida si la caché del importe cálculado tenga valor y no sea nulo(NULL)
     */
    public function tieneImporteCalculado()
    {
        return ! is_null($this->importe_cache);
    }

    /**
     * Suma cada cálculo de los conceptos de importe y el resultado lo guarda en la caché de importe calculado
     */
    public function calcularImporte()
    {
        $this->importe_cache = array_sum( $this->calcularConceptosImporte() );
    }

    /**
     * Ejecuta los cálculos de cada concepto del importe cálculado
     */
    public function calcularConceptosImporte()
    {
        $this->agregarConceptoCalcularImporte('consumo', $this->adeudo);

        foreach($this->obtenerConceptosCalcularImporte() as $concepto => $clase)
        {
            $this->agregarConceptoCalcularImporte($concepto, $clase::calcularImporte($this));
        }

        return $this->conceptos['importe'];
    }

    /**
     * Retorna un array de los conceptos para calcular el importe
     */
    public function obtenerConceptosCalcularImporte()
    {
        return [
            'convenio' => Convenio::class,
            'medidor' => Medidor::class,
            'pagare' => Pagare::class,
        ];
    }

    /**
     * Agrega el resultado de los cálculos en conceptos para posteriormente sumarlos y generar el importe calculado
     * 
     * Revisa que el $valor no sea nulo, si lo es, retorna 0;
     */
    public function agregarConceptoCalcularImporte(string $llave, $valor)
    {
        $this->conceptos['importe'][$llave] = is_numeric($valor) ? $valor : 0;
    }

    /**
     * Retorna los conceptos calculados como un desglose de cada uno de ellos con su valor.
     * 
     * En caso que el importe no haya sido calculado, ejecuta el cálculo para poder retornar su desglose
     */
    public function getImporteDesglosadoAttribute()
    {
        if(! $this->tieneImporteCalculado() )
            $this->calcularImporte();

        return $this->conceptos['importe'];
    }

    /**
     * En caso de que haya abonos(saldo) este los resta del importe calculado para dar el importe restante
     * 
     * Estos abonos pueden ser de pruebas de $1.00 ó que algún momento se permita hacer abonos personalizados
     * al importe calculado a pagar.
     */
    public function getImporteRestanteAttribute()
    {
        $restante = $this->importe_calculado - $this->saldo_calculado;
        return $restante >= 1 ? $restante : 0;
    }


    // Saldo ***********************************************************************************

    /**
     * Retorna el saldo(abonos) que se haya hecho en la plataforma.
     * 
     * 1) Verifica que el saldo haya sido calculado, en caso contrario, lo calculá
     * 
     * 2) Retorna la caché del saldo calculado.
     */
    public function getSaldoCalculadoAttribute()
    {
        if(! $this->tieneSaldoCalculado() )
            $this->calcularSaldo();

        return $this->saldo_cache;
    }

    /**
     * Verifica que la caché del saldo ha sido calculado, que tenga un valor diferente nulo(NULL)
     */
    public function tieneSaldoCalculado()
    {
        return ! is_null($this->saldo_cache);
    }

    /**
     * Suma el cálculo de los conceptos de saldo y el resultado lo guarda en caché
     */
    public function calcularSaldo()
    {
        $this->saldo_cache = array_sum( $this->calcularConceptosSaldo() );
    }

    /**
     * Ejecula el cálculo de los conceptos del saldo
     */
    public function calcularConceptosSaldo()
    {
        foreach($this->obtenerConceptosCalcularSaldo() as $concepto => $clase)
        {
            $this->agregarConceptoCalcularSaldo($concepto, $clase::calcularSaldo($this));
        }

        return $this->conceptos['saldo'];
    }

    /**
     * Retorna un array con los conceptos de saldo para calcular
     */
    public function obtenerConceptosCalcularSaldo()
    {
        return [
            'bonificacion' => Bonificacion::class,
            'historial bonificaciones' => HistorialBonificacion::class,
            'pagos diarios' => PagoDiario::class,
            'historial pagos' => HistorialPago::class,
            'transacciones' => Transaccion::class,
        ];
    }

    /**
     * Agrega al array de conceptos el resultado de la consulta del concepto de saldo
     * 
     * Revisa que sea un valor numerico, en caso contrario, retorna cero(0)
     */
    public function agregarConceptoCalcularSaldo(string $llave, $valor)
    {
        $this->conceptos['saldo'][$llave] = is_numeric($valor) ? $valor : 0;
    }

    /**
     * Retorna el array de conceptos para ver su desgloce de concepto y valor
     */
    public function getSaldoDesglosadoAttribute()
    {
        if(! $this->tieneSaldoCalculado() )
            $this->calcularSaldo();

        return $this->conceptos['saldo'];
    }


    // Validators

    /**
     * Valida si el importe calculado es menor al importe restante en base al saldo(abonos) calculado.
     * 
     * Si en caso que el importe restante es igual a cero(0) retornara false, es decir, 
     * NO requiere pago
     * 
     * Caso contrario, si retorna mayor a cero(0), el valor de este se convierte en true, por lo tanto
     * SI requiere pago.
     */
    public function requierePago()
    {
        return (bool) $this->importe_restante;
    }

    /**
     * Es exáctamente que la función requierePago(), solo que a la inversa.
     */
    public function estaPagado()
    {
        return ! $this->requirePago();
    }

    /**
     * Verifica que el saldo(abonos) calculado sea mayor a cero(0)
     */
    public function tieneAbonos()
    {
        return (bool) $this->saldo_calculado > 0;
    }


    // Asistentes

    public function formatoPrecio($numero, string $separador_miles = ',')
    {
        return number_format($numero, 2, '.', $separador_miles);
    }

    public function importeCalculadoConSeparador(string $separador_miles = ',')
    {
        return $this->formatoPrecio($this->importe_calculado, $separador_miles);
    }

    public function importeRestanteConSeparador(string $separador_miles = ',')
    {
        return $this->formatoPrecio($this->importe_restante, $separador_miles);
    }

    public function saldoCalculadoConSeparador(string $separador_miles = ',')
    {
        return $this->formatoPrecio($this->saldo_calculado, $separador_miles);
    }
}

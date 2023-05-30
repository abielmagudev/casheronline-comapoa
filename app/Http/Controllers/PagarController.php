<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagarAutorizarRequest;
use App\Http\Requests\PagarCrearRequest;
use App\Http\Requests\PagarProcesarRequest;
use App\Http\Requests\PagarValidarRequest;
use App\Mail\PagadoMail;
use App\Models\CuentaAsociada;
use App\Models\Factura;
use App\Models\TarjetaBancaria;
use App\Models\Transaccion;
use App\Outsourcing\Banorte\Clabe\Controlador as ControladorClabeBanorte;
use App\Outsourcing\Banorte\Payworks\PeticionPWS;
use App\Outsourcing\Banorte\Payworks\RespuestaPWS;
use App\Outsourcing\Banorte\ThreeDSecure\Codigos3DS;
use App\Outsourcing\Banorte\ThreeDSecure\Peticion3DS;
use App\Outsourcing\Banorte\ThreeDSecure\Respuesta3DS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PagarController extends Controller
{
    /**
     * Muestras todas las cuentas asociadas con información relacionada al pago
     * Verifica si cada cuenta asociada requiere pago o no.
     */
    public function index()
    {
        $cuentas_asociadas = CuentaAsociada::autenticado()->get();

        $numeros_cuentas_asociadas = $cuentas_asociadas->pluck('cuenta')->toArray();

        $facturas = Factura::with(['padron', 'ruta'])
                            ->whereInCuenta( $numeros_cuentas_asociadas )
                            ->paginate(5);
        
        return view('pagar.index')->with('facturas', $facturas);
    }


    /**
     * Crea el inicio del proceso de pago de la cuenta asociada
     * 
     * Validando al comienzo que la cuenta asociada pertenezca al usuario autenticado con form request.
     * 
     * Si es la primera validación es correcta, se seleccióna de tarjeta bancaria para validar 
     * propiedad y posteriormente continua para autorizar el pago con la tarjeta bancaria validada.
     * 
     * En caso que la validación haya sido cancelada ó erronea, comprueba variable "error3DS" 
     * en los parametros de la dirección URL, mostrar 
     */
    public function crear(PagarCrearRequest $request)
    {
        $factura = Factura::whereCuenta($request->numero_cuenta)->first();

        if(! $factura->requierePago() )
            return redirect()->route('pagar.index')->with('info', "Cuenta <b>{$factura->padron->numero_cuenta} - {$factura->padron->nombre_completo}</b> está pagado");

        return view('pagar.crear', [
            'factura' => $factura,
            'controladorClabeBanorte' => new ControladorClabeBanorte($factura, route('pagar.index')),
            'tarjetas_bancarias' => TarjetaBancaria::decodificadas()->whereUsuario( Auth::id() )->get(),
            'url_cancelar' => str_contains(url()->previous(), 'page=') ? url()->previous() : route('pagar.index'),
            'error3DS' => $request->filled('error3DS') &&! Codigos3DS::verificarAprobacion($request->error3DS) ? Codigos3DS::obtenerMensaje($request->error3DS, 'Error 3D Secure desconocido, intentarlo más tarde') : false,
        ]);
    }


    /**
     * Petición a 3D Secure para la validación de la tarjeta bancaria
     * 
     * Utiliza un iframe para encapsular el sitio de validación de 3D Secure del banco afiliado, 
     * En espera de la respuesta del usuario ya sea "Salir" ó ingresar código obtenido y del evento clic "Activar"
     */
    public function validar(PagarValidarRequest $request)
    {
        return view('pagar.validar', [
            'numero_cuenta' => $request->numero_cuenta,
            'peticion3DS' => new Peticion3DS(
                TarjetaBancaria::decodificada($request->tarjeta_bancaria)->first(),
                Factura::whereCuenta($request->numero_cuenta)->first(),
                route('pagar.validado', [$request->numero_cuenta, $request->tarjeta_bancaria]),
            ),
        ]);
    }


    /**
     * Respuesta(POST) de la validación de tarjeta bancaria por 3D Secure
     * 
     * Dependiendo del estatus de la respuesta
     * Regresa a la selección de tarjeta bancaria para validar nuevamente (crear)
     * O continua con el código de verificación(CVV) para autorizar el pago (autorizar-procesar)
     * 
     * No es necesario rendereizar una vista, solamente imprimir script para
     * redireccionar desde la ventana principal (window.parent), ya que la validación se
     * realizó desde un iframe
     * 
     * https://stackoverflow.com/questions/5351342/reload-parent-window-from-within-an-iframe
     */
    public function validado(Request $request)
    {
        $respuesta3DS = new Respuesta3DS($request);
        $redireccionar_js = "<script>window.parent.location.href = '%s'</script>";

        if(! $respuesta3DS->existe() )
            return sprintf($redireccionar_js, route('pagar.index', ['error3DS' => '0']));
        
        if(! $respuesta3DS->estatus->estaAprobado() )
            return sprintf($redireccionar_js, route('pagar.crear', [$request->numero_cuenta, 'error3DS' => $respuesta3DS->estatus->codigo]));
    
        $transaccion = Transaccion::guardarRespuesta3DS(
            TarjetaBancaria::decodificada($request->tarjeta_bancaria)->first(),
            Factura::whereCuenta($request->numero_cuenta)->first(),
            $respuesta3DS
        );
        
        return sprintf($redireccionar_js, route('pagar.autorizar', [$transaccion->cuenta, $transaccion->id]));
    }


    /**
     * Autoriza el pago con el código de verificación (CVV) de la tarjeta bancaria validada.
     */
    public function autorizar(PagarAutorizarRequest $request)
    {
        if(! $transaccion = Transaccion::vigente($request->id_transaccion)->first() )
            return redirect()->route('pagar.index')->with('danger', 'Transacción ó validación de tarjeta bancaria ha expirado');

        return view('pagar.autorizar', [
            'transaccion' => $transaccion,
            'factura' => Factura::whereCuenta($request->numero_cuenta)->first(),
            'patron_cvv' => config('aplicacion.regex.cvv'),
        ]);
    }


    /**
     * 1) Busca la transacción validada para procesar el pago y la tarjeta bancaria que le corresponde
     * 
     * 2) Envia la petición a Payworks a través de Guzzle Http Cliente(cURL) de Laravel y retorna la respuesta de Payworks
     * 
     * 3) Actualiza la transacción con la respuesta de Payworks y retorna la transacción actualizada para los próximos procesos
     * 
     * 4) Si la transacción no tuvo éxito por medio de la respuesta Payworks, se redirige a volver a 3D Secure y autorizar el pago
     * 
     * 5) Si la transacción tuvo éxito envia un correo electrónico con la información de la transacción efectuada a las direcciones
     *    del autenticado y si require una copia del correo electrónico a la dirección de la tarjeta bancaria.
     * 
     * 6) Redirecciona al index de Pagar con el mensaje de éxito de pago al número de cuenta referida.
     */
    public function procesar(PagarProcesarRequest $request)
    {
        $transaccion = Transaccion::find($request->id_transaccion);

        $respuestaPWS = $this->enviarPeticionPWS( 
            new PeticionPWS(
                $transaccion, 
                $request->codigo_verificacion
            )
        );

        $transaccion = Transaccion::actualizarRespuestaPayworks($respuestaPWS, $transaccion->id);

        if(! $respuestaPWS->estaAutorizado() )
            return redirect()->route('pagar.crear', $transaccion->numero_cuenta)->with('danger', $respuestaPWS->resultado->descripcion());

        $this->enviarCorreoElectronicoRespuestaPWS($transaccion);

        return redirect()->route('pagar.index')->with('success', sprintf('Gracias por tu pago al número de cuenta %s.', $transaccion->numero_cuenta));
    }


    /**
     * Envia la peitición a Payworks con las variables de enviío solicitadas para 
     * esperar respuesta de la autorización.
     * 
     * Retorna una instancia de RespuestaPWS, que es el que gestiona la respuesta
     * recibida en metodo POST por Payworks.
     * 
     * Para hacer la petición por cURL se utiliza la libreria GuzzleHttpClient de Laravel
     * https://laravel.com/docs/9.x/http-client
     */
    private function enviarPeticionPWS(PeticionPWS $peticionPWS)
    {
        $http = Http::asForm()->post(
            $peticionPWS->obtenerUrl(), 
            $peticionPWS->variablesValidas()
        );

        return new RespuestaPWS( $http->headers() );
    }


    /**
     * Envia el correo electrónico a las direcciones involucradas en la transacción y en la tarjeta bancaria
     * 
     * 1. A la dirección del autenticado
     * 2. A la dirección de la tarjeta bancaria utilizada para efectuar la transacción
     */
    private function enviarCorreoElectronicoRespuestaPWS(Transaccion $transaccion)
    {
        $mail = Mail::to( auth()->user()->correo_electronico );

        if( $transaccion->tarjeta_bancaria->enviarCopiaTransaccion() )
            $mail->cc( $transaccion->tarjeta_bancaria->info('correo') );
    
        $mail->bcc( config('mail.from.address') );

        return $mail->send( new PagadoMail($transaccion) );
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\CuentaAsociada;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReautenticarDespuesVerificacion3DSecure
{
    /**
     * Reautenticacion por número cuenta despúes de realizar la validación de 3D Secure
     * 
     * La respuesta de 3D Secure se retorna con metodo "POST" con variables de retorno básicas
     * como 'ECI', 'Estatus', 'REFERENCIA3D' hacia una ruta de verificado con $numero_cuenta en la url
     * 
     * Revisa si no existe autenticación, que provenga del metodo "POST" y que las variables de 
     * retorno básicas esten presentes para comprobar que la respuesta proviene de 3D Secure, tambien 
     * revisa que el $numero_cuenta no sea nulo, sino que contenga el valor númerico.
     * 
     * Si existe número de cuenta asociada, extrae la relación de usuario para reautenticar en la 
     * plataforma de "Paga en línea"
     * 
     * PROBLEMA: Al retornar respuesta 3D Secure, termina la sesión de usuario por lo que NO permite continuar 
     * el proceso de pago, posiblemente porque la petición proviene de un dominio diferente, 
     * conocido como XCROSS
     */
    public function handle(Request $request, Closure $next)
    {
        if( $request->isMethod('post') && $request->has(['ECI', 'Estatus', 'REFERENCIA3D']) && is_numeric($request->numero_cuenta) )
        {
           if(! Auth::check() && $cuenta_asociada = CuentaAsociada::whereNumero($request->numero_cuenta)->first() )
                Auth::login($cuenta_asociada->usuario);
        }

        return $next($request);
    }
}

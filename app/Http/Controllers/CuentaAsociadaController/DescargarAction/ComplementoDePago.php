<?php

namespace App\Http\Controllers\CuentaAsociadaController\DescargarAction;

class ComplementoDePago
{
    public $extensiones_directorios = [
        'pdf' => 'PDF\Pagos', 
        'xml' => 'XML\Pagos',
    ];

    public $titulo = 'Complemento de pago';

    public $numero_cuenta;

    public $periodo;

    public function __construct(string $numero_cuenta, string $periodo)
    {
        $this->numero_cuenta = $numero_cuenta;
        $this->periodo = $periodo;
    }

    public function obtenerDirectorioAnio(string $directorio)
    {
        return $directorio . DIRECTORY_SEPARATOR . substr($this->periodo, 0, 4) . DIRECTORY_SEPARATOR;
    }

    public function obtenerNombreArchivo(string $extension)
    {
        return 'PAG-' . $this->numero_cuenta . $this->periodo . '.' . $extension;
    }

    public function archivos()
    {
        foreach($this->extensiones_directorios as $extension => $directorio)
        {
            $archivos[] = new Archivo(
                $this->obtenerNombreArchivo($extension),
                $this->obtenerDirectorioAnio($directorio)
            );
        }
        
        return $archivos;
    }
}

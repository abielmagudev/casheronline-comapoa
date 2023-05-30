<?php

namespace App\Outsourcing\Mensajero;

use App\Outsourcing\Mensajero\Funciones\AdjuntoTrait;
use App\Outsourcing\Mensajero\Funciones\ContenidoTrait;
use App\Outsourcing\Mensajero\Funciones\DestinatarioTrait;
use App\Outsourcing\Mensajero\Funciones\RemitenteTrait;

class Mensajero extends ServicioPostal
{
    use AdjuntoTrait;
    use ContenidoTrait;
    use DestinatarioTrait;
    use RemitenteTrait;
}

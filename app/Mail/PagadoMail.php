<?php

namespace App\Mail;

use App\Models\Factura\Vencimiento;
use App\Models\TarjetaBancaria;
use App\Models\Transaccion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PagadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaccion;

    public $vencimiento;

    public function __construct(Transaccion $transaccion)
    {
        $this->transaccion = $transaccion;

        $this->vencimiento = new Vencimiento(
            $transaccion->padron->ruta->clave_dia_vencimiento,
            $transaccion->codigo_periodo
        );
    }

    public function envelope()
    {
        return new Envelope(
            subject: sprintf('Pago de cuenta %s - Paga en línea', $this->transaccion->numero_cuenta),
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.pagado',
        );
    }
}

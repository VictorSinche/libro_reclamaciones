<?php

namespace App\Mail;

use App\Models\LibroReclamacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ConfirmarRecepcionReclamo extends Mailable
{
    use Queueable, SerializesModels;

    public LibroReclamacion $reclamo;

    public function __construct(LibroReclamacion $reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function build()
    {
        // Generar el PDF en memoria con la misma vista que usas para descargar
        $pdf = Pdf::loadView('libro_reclamaciones.modelolibre.hoja', [
            'reclamo' => $this->reclamo
        ])->setPaper('A4', 'portrait');

        return $this->subject('Confirmación de recepción de reclamo')
                    ->markdown('emails.reclamo.confirmacion')
                    ->attachData($pdf->output(), "hoja-reclamacion-UMA-{$this->reclamo->id}.pdf", [
                        'mime' => 'application/pdf',
                    ]);
    }
}

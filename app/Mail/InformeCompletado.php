<?php

namespace App\Mail;

use App\Models\Derivacion; // ✅ IMPORTANTE: importar el modelo
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InformeCompletado extends Mailable
{
    use Queueable, SerializesModels;

    public $derivacion;

    public function __construct(Derivacion $derivacion)
    {
        $this->derivacion = $derivacion;
    }

    public function build()
    {
        return $this->subject('✅ Informe completado del Libro de Reclamaciones')
                    ->view('emails.informe_completado')
                    ->with([
                        'derivacion' => $this->derivacion,
                        'responsable' => $this->derivacion->responsable,
                    ]);
    }
}
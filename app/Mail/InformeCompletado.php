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
                    ->cc([
                        'mesadepartes@uma.edu.pe',
                        'yulan.cristobal@uma.edu.pe',
                        'g.abarca.moran@gmail.com',
                        'sinchevictorhugo@gmail.com',
                        // 'vitosh2911@gmail.com',
                        // 'victor.sinche@uma.edu.pe',
                        'sistemas@uma.edu.pe'
                    ])
                    ->view('emails.informe_completado')
                    ->with([
                        'derivacion' => $this->derivacion,
                        'responsable' => $this->derivacion->responsable,
                    ]);
    }
}
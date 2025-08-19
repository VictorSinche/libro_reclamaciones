<?php

namespace App\Mail;

use App\Models\Derivacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionReclamoPendiente extends Mailable
{
    use Queueable, SerializesModels;

    public $derivacion;

    public function __construct(Derivacion $derivacion)
    {
        $this->derivacion = $derivacion;
    }

    public function build()
    {
    return $this->subject('🔔 Reclamo pendiente por atender')
                ->to('notificaciones@uma.edu.pe') // 👈 correo genérico de salida
                ->cc([
                    'sinchevictorhugo@gmail.com',
                    'vitosh2911@gmail.com',
                ])
                ->view('emails.notificacion_reclamo_pendiente');
    }
}

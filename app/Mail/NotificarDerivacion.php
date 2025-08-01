<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotificarDerivacion extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamo;
    public $area;

    public function __construct($reclamo, $area)
    {
        $this->reclamo = $reclamo;
        $this->area = $area;
    }

    public function build()
    {
        Log::debug('✉️ Construyendo correo para el reclamo de: ' . $this->reclamo->nombre_apellido);
        
        return $this->from(config('mail.from.address'), 'Libro de Reclamaciones') // 👈 aquí lo fuerzas
                    ->subject('📩 Nueva derivación de hoja de reclamación')
                    ->view('emails.derivacion_notificada');
    }
}

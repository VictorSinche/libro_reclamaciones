<?php

// app/Mail/NotificarResponsableLibroReclamacion.php

namespace App\Mail;

use App\Models\LibroReclamacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarResponsableLibroReclamacion extends Mailable
{
    use Queueable, SerializesModels;

    public $reclamo;

    public function __construct(LibroReclamacion $reclamo)
    {
        $this->reclamo = $reclamo;
    }

    public function build()
    {
        return $this->subject('📥 Nuevo reclamo ingresado - Libro de Reclamaciones')
                    ->to('notificaciones@uma.edu.pe') // 👈 correo genérico de salida
                    ->cc([
                        'mesadepartes@uma.edu.pe',
                        'yulan.cristobal@uma.edu.pe',
                        'g.abarca.moran@gmail.com '
                    ])
                    ->view('emails.responsable.reclamo')
                    ->with(['reclamo' => $this->reclamo]);
    }

}

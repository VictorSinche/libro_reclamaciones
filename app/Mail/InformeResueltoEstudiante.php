<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class InformeResueltoEstudiante extends Mailable
{
    use Queueable, SerializesModels;

    public $derivacion;

    public function __construct($derivacion)
    {
        $this->derivacion = $derivacion;
    }

    public function build()
    {
        $reclamo = $this->derivacion->libroReclamacion;
        $nombre = $reclamo->nombre_apellido;

        // Ruta relativa desde la base de datos
        $rutaRelativa = $reclamo->informe_responsable;

        // Ruta absoluta en disco 'public'
        $rutaAbsoluta = storage_path("app/public/informes_responsables/{$rutaRelativa}");

        $correo = $this->subject('📬 Informe de su reclamo - UMA')
                       ->markdown('emails.informe_estudiante')
                       ->with([
                           'nombre' => $nombre,
                       ]);

        // Verificamos si el archivo existe antes de adjuntarlo
        if (file_exists($rutaAbsoluta)) {
            $correo->attach($rutaAbsoluta, [
                'as' => "Informe_Reclamo_UMA.pdf",
                'mime' => 'application/pdf',
            ]);
        }

        return $correo;
    }
}

<?php

namespace App\Console\Commands;

use App\Mail\NotificacionReclamoPendiente;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Derivacion;
use App\Models\UserAdmin;

class NotificarDerivacionesPendientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notificar-derivaciones-pendientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('⏰ Ejecutando comando de notificación automática...');

        $limiteDias = now()->subMinute(2);

        $derivaciones = Derivacion::with(['libroReclamacion', 'area'])
            ->where('estado', 0)
            ->whereDate('created_at', '<=', $limiteDias)
            ->get();

        foreach ($derivaciones as $derivacion) {
            $usuario = UserAdmin::where('area_id', $derivacion->area_id)->first();
            $responsable = config('mail.from.address') ?? 'notificaciones@uma.edu.pe';

            if ($usuario && filter_var($usuario->email, FILTER_VALIDATE_EMAIL)) {
                Mail::to($usuario->email)->send(new NotificacionReclamoPendiente($derivacion));
            }

            if ($responsable && filter_var($responsable, FILTER_VALIDATE_EMAIL)) {
                Mail::to($responsable)->send(new NotificacionReclamoPendiente($derivacion));
            }

            Log::info("📨 Notificación enviada para derivación pendiente ID: {$derivacion->id}");
        }

        return Command::SUCCESS;
    }

}

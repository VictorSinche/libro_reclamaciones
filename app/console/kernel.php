<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Aquí registrarás tus comandos personalizados si los necesitas
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('app:notificar-derivaciones-pendientes')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}

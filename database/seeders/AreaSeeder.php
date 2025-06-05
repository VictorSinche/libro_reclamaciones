<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = ['COA', 'OSAR', 'TI', 'TESORERIA', 'ADMISION'];

        foreach ($areas as $nombre) {
            DB::table('areas')->updateOrInsert(
                ['nombre' => $nombre], // condición
                ['updated_at' => now(), 'created_at' => now()] // datos a insertar/actualizar
            );
        }
    }
}

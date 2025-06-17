<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            'OSAR',
            'TESORERIA',
            'TI',
            'ADMISION',
            'COA',
            'Adm. y Negocios',
            // 'Adm. y Marketing',
            'Contab. y Finanzas',
            'Ing. IA',
            'Farmacia',
            'Enfermería',
            'Psicología',
            'Nutrición',
            // 'TM Fis. y Rehab.',
            'TM Lab. y Anat. Pat.'
        ];

        foreach ($areas as $nombre) {
            DB::table('areas')->updateOrInsert(
                ['nombre' => $nombre], // condición
                ['updated_at' => now(), 'created_at' => now()] // datos a insertar/actualizar
            );
        }
    }
}

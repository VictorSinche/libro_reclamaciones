<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['nombre' => 'Permisos', 'codigo' => 'PER'],
            ['nombre' => 'Postulante', 'codigo' => 'POS'],
            ['nombre' => 'Admisión', 'codigo' => 'ADM'],
            ['nombre' => 'COA', 'codigo' => 'COA'],
            ['nombre' => 'OSAR', 'codigo' => 'OSA'],
            ['nombre' => 'Director', 'codigo' => 'DIR'],
            ['nombre' => 'Tesorería', 'codigo' => 'TES'],
            ['nombre' => 'TI', 'codigo' => 'TI'],
            ['nombre' => 'Area legal', 'codigo' => 'AL'],
            
            ['nombre' => 'Administración y Negocios', 'codigo' => 'AN'],
            ['nombre' => 'Administración y Marketing', 'codigo' => 'AM'],
            ['nombre' => 'Contabilidad y finanzas', 'codigo' => 'CF'],
            ['nombre' => 'Ingeniería de IA', 'codigo' => 'IA'],
            ['nombre' => 'Farmacia', 'codigo' => 'FAR'],
            ['nombre' => 'Enfermería', 'codigo' => 'ENF'],
            ['nombre' => 'Psicología', 'codigo' => 'PSI'],
            ['nombre' => 'Nutrición', 'codigo' => 'NUT'],
            ['nombre' => 'TM Fis. y Rehab.', 'codigo' => 'TFR'],
            ['nombre' => 'TM Lab. y Anat. Pat.', 'codigo' => 'TLP']
        ];

        foreach ($modules as $modulo) {
            DB::table('modules')->updateOrInsert(
                ['codigo' => $modulo['codigo']], // Condición de búsqueda
                [
                    'nombre' => $modulo['nombre'],
                    'estado' => 'A',
                    'updated_at' => now(),
                    'created_at' => now()
                ]
            );
        }
    }
}

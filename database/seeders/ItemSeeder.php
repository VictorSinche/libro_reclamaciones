<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los IDs de los módulos por código
        $modulos = DB::table('modules')->pluck('id', 'codigo');

        $items = [
            // Permisos
            ['module_codigo' => 'PER', 'nombre' => 'Lista de Usuarios', 'codigo' => 'PER.1'],
            ['module_codigo' => 'PER', 'nombre' => 'Permisos de Usuario', 'codigo' => 'PER.2'],
            ['module_codigo' => 'PER', 'nombre' => 'Permisos de Usuario', 'codigo' => 'PER.3'],
            
            // Admisión
            ['module_codigo' => 'ADM', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'ADM.1'],

            // COA
            ['module_codigo' => 'COA', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'COA.1'],

            // OSAR
            ['module_codigo' => 'OSA', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'OSA.1'],

            // Tesorería
            ['module_codigo' => 'TES', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TES.1'],

            // Area responsable
            ['module_codigo' => 'AL', 'nombre' => 'Hojas reclamaciones', 'codigo' => 'AL.1'],
            
            // TI
            ['module_codigo' => 'TI', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TI.1'],

            // Direccion de escuela
            ['module_codigo' => 'AN', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'AN.1'],
            ['module_codigo' => 'AM', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'AM.1'],
            ['module_codigo' => 'CF', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'CF.1'],
            ['module_codigo' => 'IA', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'IA.1'],
            ['module_codigo' => 'FAR', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'FAR.1'],
            ['module_codigo' => 'ENF', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'ENF.1'],
            ['module_codigo' => 'PSI', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'PSI.1'],
            ['module_codigo' => 'NUT', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'NUT.1'],
            ['module_codigo' => 'TFR', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TFR.1'],
            ['module_codigo' => 'TLP', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TLP.1']
        ];

        foreach ($items as $item) {
            $moduleId = $modulos[$item['module_codigo']] ?? null;

            if ($moduleId) {
                DB::table('items')->updateOrInsert(
                    ['module_id' => $moduleId, 'codigo' => $item['codigo']],
                    [
                        'nombre' => $item['nombre'],
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }
        }
    }
}

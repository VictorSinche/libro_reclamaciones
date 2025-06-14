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
            // Postulante
            ['module_codigo' => 'POS', 'nombre' => 'Informacion Personal', 'codigo' => 'POS.1'],
            ['module_codigo' => 'POS', 'nombre' => 'Pagos Incripcion', 'codigo' => 'POS.2'],
            ['module_codigo' => 'POS', 'nombre' => 'Adjuntar Documentos', 'codigo' => 'POS.3'],
            ['module_codigo' => 'POS', 'nombre' => 'Ver Horario', 'codigo' => 'POS.4'],

            // Admisión
            ['module_codigo' => 'ADM', 'nombre' => 'Lista de postulantes', 'codigo' => 'ADM.1'],
            ['module_codigo' => 'ADM', 'nombre' => 'Historial declaración jurada', 'codigo' => 'ADM.2'],            
            ['module_codigo' => 'ADM', 'nombre' => 'Reclamaciones derivadas', 'codigo' => 'ADM.3'],
            ['module_codigo' => 'ADM', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'ADM.4'],
            
            // Director
            ['module_codigo' => 'DIR', 'nombre' => 'Convalidación', 'codigo' => 'DIR.1'],

            // COA
            ['module_codigo' => 'COA', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'COA.1'],

            // OSAR
            ['module_codigo' => 'OSA', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'OSA.1'],

            // Tesorería
            ['module_codigo' => 'TES', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TES.1'],

            // Area responsable
            ['module_codigo' => 'AL', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'AL.1'],
            
            // TI
            ['module_codigo' => 'TI', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'TI.1'],

            // Direccion de escuela
            ['module_codigo' => 'DE', 'nombre' => 'Hojas reclamaciones derivadas', 'codigo' => 'DE.1'],
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

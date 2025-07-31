<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            ['nombre' => 'OSAR', 'apellidos' => 'OF.', 'email' => 'osar@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('osar132'), 'area_id' => 1],
            ['nombre' => 'TESORERIA', 'apellidos' => 'OF.', 'email' => 'tesoreria@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 2, 'password' => Hash::make('tesoreria123'), 'area_id' => 1],
            ['nombre' => 'TI', 'apellidos' => 'OF.', 'email' => 'helpdesk@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 3, 'password' => Hash::make('helpdesk123'), 'area_id' => 1],
            ['nombre' => 'ADMISION', 'apellidos' => 'OF.', 'email' => 'admision@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 4, 'password' => Hash::make('admision123'), 'area_id' => 1],
            ['nombre' => 'COA', 'apellidos' => 'OF.', 'email' => 'coacademica@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('coa123'), 'area_id' => 1],
            ['nombre' => 'Administración y Negocios', 'apellidos' => 'OF.', 'email' => 'christian.perez@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('adminnegocios123'), 'area_id' => 1],
            // ['nombre' => 'Administración y Marketing', 'apellidos' => 'OF.', 'email' => 'christian.perez@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('adminmarketing123'), 'area_id' => 1],
            ['nombre' => 'Contabilidad y finanzas', 'apellidos' => 'OF.', 'email' => 'marcelo.gonzales@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('contabilidad123'), 'area_id' => 1],
            ['nombre' => 'Ingeniería de IA', 'apellidos' => 'OF.', 'email' => 'freud.melgar@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('ingia123'), 'area_id' => 1],
            ['nombre' => 'Farmacia', 'apellidos' => 'OF.', 'email' => 'jhonnel.samaniego@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('farmacia123'), 'area_id' => 1],
            ['nombre' => 'Enfermería', 'apellidos' => 'OF.', 'email' => 'roxana.purizaca@uma.edu.pe', 'genero' => 'femenino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('enfermeria123'), 'area_id' => 1],
            ['nombre' => 'Psicología', 'apellidos' => 'OF.', 'email' => 'Luis.luyo@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('psicologo123'), 'area_id' => 1],
            ['nombre' => 'Nutrición y Dietética', 'apellidos' => 'OF.', 'email' => 'ito.flores@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('nutricion123'), 'area_id' => 1],
            // ['nombre' => 'Tecnología Medica en terapia física y rehabilitación', 'apellidos' => 'OF.', 'email' => 'carlos.villalta@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('tecrapiafisica123'), 'area_id' => 1],
            ['nombre' => 'Tecnología medica en laboratorio clínico y anatomía patológica', 'apellidos' => 'OF.', 'email' => 'carlos.villalta@uma.edu.pe', 'genero' => 'masculino', 'grado' => 'OF.', 'estado' => 1, 'password' => Hash::make('tecmelaboratorio123'), 'area_id' => 1],
        ];

        DB::table('users_admin')->insert($usuarios);
    }
}

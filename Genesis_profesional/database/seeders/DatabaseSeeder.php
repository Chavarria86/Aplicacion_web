<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Personal Administrativo (Supervisor y Vicedecano)
        $supervisorId = DB::table('personal_administrativo')->insertGetId([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'correo_institucional' => 'supervisor@ugb.edu.sv',
            'password' => Hash::make('password'),
            'cargo' => 'supervisor'
        ]);

        DB::table('personal_administrativo')->insert([
            'nombres' => 'Decano',
            'apellidos' => 'Génesis',
            'correo_institucional' => 'vicedecano@ugb.edu.sv',
            'password' => Hash::make('password'),
            'cargo' => 'vice_decano'
        ]);

        // 2. Seed Estudiantes (Base institucional)
        DB::table('estudiantes')->insert([
            'codigo_estudiante' => 'USSS027724',
            'nombres' => 'Jose Emerson',
            'apellidos' => 'Chavarria',
            'genero' => 'Masculino',
            'estado_civil' => 'Soltero',
            'dui' => '06123456-7',
            'direccion' => 'San Miguel, El Salvador',
            'fecha_nacimiento' => '2001-05-15',
            'departamento_nacimiento' => 'San Miguel',
            'municipio_nacimiento' => 'San Miguel',
            'pais' => 'El Salvador',
            'correo_principal' => 'emersonchavarria578@gmail.com',
            'correo_secundario' => 'usss027724@ugb.edu.sv',
            'celular' => '7777-7777',
            'es_estudiante_activo' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // 3. Seed Usuarios para login unificado
        // Pasante
        $pasanteUserId = DB::table('usuarios')->insertGetId([
            'nombres' => 'Jose Emerson',
            'apellidos' => 'Chavarria',
            'correo_institucional' => 'usss027724@ugb.edu.sv',
            'password' => Hash::make('password'),
            'estado' => 'activo',
            'rol' => 'pasante',
            'fecha_registro' => now()
        ]);

        // Supervisor
        DB::table('usuarios')->insert([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'correo_institucional' => 'supervisor@ugb.edu.sv',
            'password' => Hash::make('password'),
            'estado' => 'activo',
            'rol' => 'supervisor',
            'fecha_registro' => now()
        ]);

        // Vice Decano
        DB::table('usuarios')->insert([
            'nombres' => 'Decano',
            'apellidos' => 'Génesis',
            'correo_institucional' => 'vicedecano@ugb.edu.sv',
            'password' => Hash::make('password'),
            'estado' => 'activo',
            'rol' => 'vice_decano',
            'fecha_registro' => now()
        ]);

        // 4. Seed Pasantes
        DB::table('pasantes')->insert([
            'usuario_id' => $pasanteUserId,
            'area' => 'Ingeniería en Sistemas',
            'tipo_pasantia' => 'interna',
            'estado' => 'en_proceso',
            'fase_actual' => 'F1',
            'horas_aprobadas' => 0.00,
            'supervisor_id' => $supervisorId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->call(EstudiantesSeeder::class);
    }
}

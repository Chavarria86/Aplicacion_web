<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudiantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiantes = [
            [
                'codigo_estudiante' => 'USIS012324',
                'nombres' => 'Ana Maria',
                'apellidos' => 'Gomez Lopez',
                'genero' => 'Femenino',
                'estado_civil' => 'Soltera',
                'dui' => '05432109-8',
                'direccion' => 'San Miguel, El Salvador',
                'fecha_nacimiento' => '2002-08-20',
                'departamento_nacimiento' => 'San Miguel',
                'municipio_nacimiento' => 'San Miguel',
                'pais' => 'El Salvador',
                'correo_principal' => 'anamaria.gomez@gmail.com',
                'correo_secundario' => 'usis012324@ugb.edu.sv',
                'celular' => '7123-4567',
                'es_estudiante_activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo_estudiante' => 'USIS098724',
                'nombres' => 'Carlos Roberto',
                'apellidos' => 'Mendoza Ramos',
                'genero' => 'Masculino',
                'estado_civil' => 'Soltero',
                'dui' => '07654321-0',
                'direccion' => 'La Union, El Salvador',
                'fecha_nacimiento' => '2000-11-12',
                'departamento_nacimiento' => 'La Union',
                'municipio_nacimiento' => 'La Union',
                'pais' => 'El Salvador',
                'correo_principal' => 'carlos.mendoza@gmail.com',
                'correo_secundario' => 'usis098724@ugb.edu.sv',
                'celular' => '7890-1234',
                'es_estudiante_activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'codigo_estudiante' => 'USIS045624',
                'nombres' => 'Gabriela Sofia',
                'apellidos' => 'Vasquez Duran',
                'genero' => 'Femenino',
                'estado_civil' => 'Soltera',
                'dui' => '08765432-1',
                'direccion' => 'Usulutan, El Salvador',
                'fecha_nacimiento' => '2003-03-25',
                'departamento_nacimiento' => 'Usulutan',
                'municipio_nacimiento' => 'Usulutan',
                'pais' => 'El Salvador',
                'correo_principal' => 'gabriela.sofia@gmail.com',
                'correo_secundario' => 'usis045624@ugb.edu.sv',
                'celular' => '7234-5678',
                'es_estudiante_activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($estudiantes as $estudiante) {
            $exists = DB::table('estudiantes')
                ->where('codigo_estudiante', $estudiante['codigo_estudiante'])
                ->orWhere('correo_secundario', $estudiante['correo_secundario'])
                ->exists();

            if (!$exists) {
                DB::table('estudiantes')->insert($estudiante);
            }
        }
    }
}

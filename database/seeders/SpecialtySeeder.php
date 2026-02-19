<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiología', 'description' => 'Especialista en enfermedades del corazón y sistema cardiovascular'],
            ['name' => 'Pediatría', 'description' => 'Especialista en salud y enfermedades de niños'],
            ['name' => 'Neurología', 'description' => 'Especialista en enfermedades del sistema nervioso'],
            ['name' => 'Dermatología', 'description' => 'Especialista en enfermedades de la piel'],
            ['name' => 'Oftalmología', 'description' => 'Especialista en enfermedades de los ojos'],
            ['name' => 'Otorrinolaringología', 'description' => 'Especialista en enfermedades del oído, nariz y garganta'],
            ['name' => 'Ginecología', 'description' => 'Especialista en salud de la mujer y sistema reproductivo'],
            ['name' => 'Cirugía General', 'description' => 'Especialista en procedimientos quirúrgicos generales'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate(['name' => $specialty['name']], $specialty);
        }
    }
}

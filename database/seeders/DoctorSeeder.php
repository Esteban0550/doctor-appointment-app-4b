<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'Dr. Carlos Méndez',
                'email' => 'carlos.mendez@hospital.com',
                'specialty' => 'Cardiología',
                'license_number' => 'MED-2026-101',
                'biography' => 'Especialista en cardiología con más de 10 años de experiencia en diagnóstico y tratamiento de enfermedades cardiovasculares.',
            ],
            [
                'name' => 'Dra. Ana García',
                'email' => 'ana.garcia@hospital.com',
                'specialty' => 'Pediatría',
                'license_number' => 'MED-2026-102',
                'biography' => 'Pediatra con amplia experiencia en el cuidado de la salud infantil y adolescente.',
            ],
            [
                'name' => 'Dr. Roberto López',
                'email' => 'roberto.lopez@hospital.com',
                'specialty' => 'Neurología',
                'license_number' => 'MED-2026-103',
                'biography' => 'Neurólogo especializado en trastornos del sistema nervioso central y periférico.',
            ],
            [
                'name' => 'Dra. María Fernández',
                'email' => 'maria.fernandez@hospital.com',
                'specialty' => 'Dermatología',
                'license_number' => 'MED-2026-104',
                'biography' => 'Dermatóloga con experiencia en tratamientos de piel, cabello y uñas.',
            ],
            [
                'name' => 'Dr. José Ramírez',
                'email' => 'jose.ramirez@hospital.com',
                'specialty' => 'Oftalmología',
                'license_number' => 'MED-2026-105',
                'biography' => 'Oftalmólogo especializado en cirugía de cataratas y corrección visual.',
            ],
        ];

        foreach ($doctors as $doctorData) {
            $user = User::firstOrCreate(
                ['email' => $doctorData['email']],
                [
                    'name' => $doctorData['name'],
                    'password' => Hash::make('password'),
                ]
            );

            $user->assignRole('Doctor');

            $specialty = Specialty::where('name', $doctorData['specialty'])->first();

            Doctor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialty_id' => $specialty?->id,
                    'license_number' => $doctorData['license_number'],
                    'biography' => $doctorData['biography'],
                ]
            );
        }
    }
}

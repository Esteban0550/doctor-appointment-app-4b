<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // llamar a RoleSeeder
        $this->call(RoleSeeder::class);

        // Crear un usuario de prueba
        User::factory()->create([
            'name' => 'Nugget de Pollo',
            'email' => 'estebanpriego2005@gmail.com',
            'password' => bcrypt('Moguel2005'),
        ]);
    }}
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423

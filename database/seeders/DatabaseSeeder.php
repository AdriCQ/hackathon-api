<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nombre' => 'Admin',
            'apellido_paterno' => 'UMSS',
            'apellido_materno' => 'API',
            'telefono' => env('ADMIN_PHONE', ''),
            'email' => env('ADMIN_EMAIL', 'admin@email.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD', 'password')),
        ]);
    }
}

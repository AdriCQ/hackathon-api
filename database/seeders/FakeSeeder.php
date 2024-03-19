<?php

namespace Database\Seeders;

use App\Models\Analisis;
use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->has(
                Analisis::factory()
                    ->count(3)
                    ->has(
                        Media::factory()
                            ->count(2),
                        'multimedias'
                    ),
                'analisis'
            )
            ->create();
    }
}

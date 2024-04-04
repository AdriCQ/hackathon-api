<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Ultrasonido;
use App\Models\User;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            DatabaseSeeder::class,
        ]);

        User::factory()
            ->count(10)
            ->has(
                Ultrasonido::factory()
                    ->count(5)
                    ->has(
                        Media::factory()
                            ->count(10),
                        'multimedias'
                    ),
                'ultrasonidos'
            )
            ->create();
    }
}

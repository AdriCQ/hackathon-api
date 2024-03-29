<?php

namespace Database\Factories;

use App\Models\Ultrasonido;
use Illuminate\Database\Eloquent\Factories\Factory;

class UltrasonidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Ultrasonido::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->realText(100),
            'descripcion' => fake()->realText(),
            'secret' => fake()->numerify('####'),
            'created_at' => now(),
        ];
    }
}

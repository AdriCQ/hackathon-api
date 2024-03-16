<?php

namespace Database\Factories;

use App\Enums\MediaEnum;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Media::class;

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
            'tipo' => fake()->randomElement([
                MediaEnum::IMAGE->name,
                MediaEnum::VIDEO->name,
            ]),
            'disk' => 'public',
            'url' => fake()->url(),
        ];
    }
}

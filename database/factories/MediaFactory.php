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
        $type = fake()->randomElement([
            MediaEnum::IMAGE->name,
            MediaEnum::VIDEO->name,
        ]);

        $url = $type === MediaEnum::VIDEO->name
            ? fake()->randomElement([
                'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4',
                'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4',
                'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
                'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4',
            ])
            : fake()->imageUrl;

        return [
            'titulo' => fake()->realText(100),
            'descripcion' => fake()->realText(),
            'tipo' => $type,
            'disk' => 'public',
            'url' => $url,
        ];
    }
}

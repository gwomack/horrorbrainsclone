<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\VideoEmbeds;

class VideoEmbedsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VideoEmbeds::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url' => fake()->url(),
            'type' => fake()->randomElement(["youtube","vimeo"]),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'movie_id' => Movie::factory(),
        ];
    }
}

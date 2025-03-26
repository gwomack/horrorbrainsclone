<?php

namespace Database\Factories\Movie;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie\Movie;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'release_date' => fake()->date(),
            'rating' => fake()->randomFloat(0, 0, 9999999999.),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
        ];
    }
}

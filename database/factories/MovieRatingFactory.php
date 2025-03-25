<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\MovieRating;
use App\Models\User;

class MovieRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieRating::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'rating' => fake()->randomNumber(),
            'user_id' => User::factory(),
        ];
    }
}

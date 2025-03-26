<?php

namespace Database\Factories\Post;

use App\Models\User;
use App\Models\Post\Post;
use Illuminate\Support\Str;
use App\Models\Post\PostRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostRatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostRating::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::factory(),
            'rating' => fake()->randomNumber(),
            'user_id' => User::factory(),
        ];
    }
}

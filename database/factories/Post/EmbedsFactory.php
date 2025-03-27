<?php

namespace Database\Factories\Post;

use App\Models\Post\Embed;
use App\Models\Post\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmbedsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Embed::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'url' => fake()->url(),
            'type' => fake()->randomElement(['youtube', 'vimeo']),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'post_id' => Post::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Embed;
use App\Models\Post;

class EmbedFactory extends Factory
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
            'embed' => fake()->word(),
            'type' => fake()->randomElement(["youtube","vimeo"]),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'post_id' => Post::factory(),
        ];
    }
}

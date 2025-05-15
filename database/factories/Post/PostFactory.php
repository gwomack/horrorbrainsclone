<?php

namespace Database\Factories\Post;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $title = fake()->sentence(4),
            'slug' => Str::slug($title),
            'description' => fake()->text(),
            'release_date' => fake()->date(),
            'rating' => fake()->randomFloat(0, 0, 5),
            'is_published' => $isPublished = fake()->boolean(),
            'published_at' => $isPublished ? fake()->dateTime() : null,
        ];
    }
}

<?php

namespace Database\Factories\Tag;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->name(),
            'slug' => Str::slug($name),
            'description' => fake()->text(),
        ];
    }
}

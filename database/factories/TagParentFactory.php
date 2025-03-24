<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\TagParent;

class TagParentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagParent::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tag_id' => fake()->randomNumber(),
            'parent_id' => fake()->randomNumber(),
            'tag_parent_id' => TagParent::factory(),
        ];
    }
}

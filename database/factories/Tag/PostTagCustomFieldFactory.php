<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Post\PostTag;
use App\Models\Tag\PostTagCustomField;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagCustomFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostTagCustomField::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'post_tag_id' => PostTag::factory(),
            'field' => fake()->word(),
            'value' => fake()->text(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PostTag;
use App\Models\PostTagCustomField;
use App\Models\Tag;

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
            'tag_id' => Tag::factory(),
            'field' => fake()->word(),
            'value' => fake()->text(),
            'post_tag_id' => PostTag::factory(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\TagCustomField;

class TagCustomFieldFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagCustomField::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'tag_id' => Tag::factory(),
            'field' => fake()->word(),
            'value' => fake()->text(),
        ];
    }
}

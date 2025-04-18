<?php

namespace Database\Factories\Tag;

use App\Models\Tag\Tag;
use App\Models\Tag\TagParent;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'tag_id' => Tag::factory(),
            'parent_id' => Tag::factory(),
        ];
    }
}

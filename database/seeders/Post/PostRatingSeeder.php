<?php

namespace Database\Seeders\Post;

use App\Models\Post\PostRating;
use Illuminate\Database\Seeder;

class PostRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostRating::factory()->count(5)->create();
    }
}

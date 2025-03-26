<?php

namespace Database\Seeders\Post;

use App\Models\Post\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(5)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\PostTag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostTag::factory()->count(5)->create();
    }
}

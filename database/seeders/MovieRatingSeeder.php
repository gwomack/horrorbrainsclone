<?php

namespace Database\Seeders;

use App\Models\MovieRating;
use Illuminate\Database\Seeder;

class MovieRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieRating::factory()->count(5)->create();
    }
}

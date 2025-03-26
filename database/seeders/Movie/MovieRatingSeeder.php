<?php

namespace Database\Seeders\Movie;

use App\Models\Movie\MovieRating;
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

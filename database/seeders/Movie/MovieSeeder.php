<?php

namespace Database\Seeders\Movie;

use App\Models\Movie\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()->count(5)->create();
    }
}

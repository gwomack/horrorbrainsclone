<?php

namespace Database\Seeders;

use App\Models\MovieTag;
use Illuminate\Database\Seeder;

class MovieTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MovieTag::factory()->count(5)->create();
    }
}

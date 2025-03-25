<?php

namespace Database\Seeders;

use App\Models\TagParent;
use Illuminate\Database\Seeder;

class TagParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagParent::factory()->count(5)->create();
    }
}

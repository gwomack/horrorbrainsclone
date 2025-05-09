<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Tag\TagSeeder;
use Database\Seeders\Post\PostSeeder;
use Database\Seeders\Post\PostRatingSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@admin.com',
        // ]);

        // call BookSeeder
        $this->call(
            [
                // BookSeeder::class,
                // PostSeeder::class,
                // ContactSeeder::class,
                PostSeeder::class,
                TagSeeder::class,
                PostRatingSeeder::class,
            ]
        );
    }
}

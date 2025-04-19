<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmdb_pages', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->autoIncrement();
            $table->unsignedInteger('page');
            $table->timestamps();
        });

        Schema::create('tmdb_total_pages', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->autoIncrement();
            $table->unsignedInteger('total');
            $table->timestamps();
        });

        DB::table('tmdb_total_pages')->insert(['total' => 50000, 'created_at' => now(), 'updated_at' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmdb_pages');
        Schema::dropIfExists('tmdb_total_pages');
    }
};

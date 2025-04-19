<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tmdb_pages', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary()->autoIncrement();
            $table->unsignedSmallInteger('page');
            $table->timestamps();
        });

        Schema::create('tmdb_total_pages', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary()->autoIncrement();
            $table->unsignedSmallInteger('total');
            $table->timestamps();
        });
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

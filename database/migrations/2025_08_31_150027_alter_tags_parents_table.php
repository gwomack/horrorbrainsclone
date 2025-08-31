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
        Schema::table('tag_parents', function (Blueprint $table) {
            $table->index('tag_id');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tag_parents', function (Blueprint $table) {
            $table->dropIndex('tag_id');
            $table->dropIndex('parent_id');
        });
    }
};

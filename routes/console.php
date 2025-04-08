<?php

use App\Models\Trending;
use Illuminate\Support\Facades\Artisan;

Artisan::command('trending:clean', function () {
    Trending::where('updated_at', '<', now()->subDays(30))->delete();
})->purpose('Clean up trending records older than 30 days')->daily();

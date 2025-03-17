<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});

// Movie details route with optional ID parameter
Route::get('/movie/{id?}', function ($id = null) {
    // For now, we'll just return the view
    // Later, you can fetch movie data based on the ID
    return view('movie-details');
})->name('movie.details');

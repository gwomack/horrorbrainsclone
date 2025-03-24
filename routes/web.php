<?php

use App\Livewire\HomePage;
use App\Livewire\MovieDetailPage;
use App\Livewire\MovieSearchPage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomePage::class);

// Movie details route with optional ID parameter
Route::get('/movie/{id?}', MovieDetailPage::class)->name('movie.details');

Route::get('/search', MovieSearchPage::class)->name('movie.search');

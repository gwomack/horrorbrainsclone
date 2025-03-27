<?php

use App\Livewire\HomePage;
use App\Livewire\MovieDetailPage;
use App\Livewire\MovieSearchPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);

Route::get('/search', MovieSearchPage::class)->name('movie.search');

Route::get('/{id?}', MovieDetailPage::class)->name('movie.details');

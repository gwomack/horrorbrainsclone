<?php

use App\Livewire\HomePage;
use App\Livewire\MovieDetailPage;
use App\Livewire\MovieSearchPage\MovieSearchPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/search', MovieSearchPage::class)->name('movie.search');

Route::get('/{post?}', MovieDetailPage::class)->name('movie.details');

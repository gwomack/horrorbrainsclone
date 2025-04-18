<?php

use App\Livewire\AboutUsPage;
use App\Livewire\CommentPolicyPage;
use App\Livewire\HomePage;
use App\Livewire\MovieDetailPage;
use App\Livewire\MovieSearchPage\MovieSearchPage;
use App\Livewire\PrivacyPolicyPage;
use App\Livewire\TermsAndConditionsPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');

Route::get('/search', MovieSearchPage::class)->name('movie.search');

Route::get('/about-us', AboutUsPage::class)->name('aboutus');
Route::get('/privacy-policy', PrivacyPolicyPage::class)->name('privacypolicy');
Route::get('/terms-and-conditions', TermsAndConditionsPage::class)->name('termsconditions');
Route::get('/comment-policy', CommentPolicyPage::class)->name('commentpolicy');

Route::get('/{post?}', MovieDetailPage::class)->name('movie.details');

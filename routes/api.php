<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TMDBController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::post('/login', [AuthController::class, 'login']);

Route::post('/tmdb/random-page', [TMDBController::class, 'getRandomPage'])->middleware('auth:sanctum');

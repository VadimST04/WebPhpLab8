<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalApiController;

Route::get('/external/posts', [ExternalApiController::class, 'posts']);
Route::get('/external/posts/{id}', [ExternalApiController::class, 'show']);
Route::post('/external/posts', [ExternalApiController::class, 'store']);

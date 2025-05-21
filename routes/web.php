<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\public\PublicApiController;

Route::get('/', function () {
    return view('welcome');
});
// Prueba que todo okey... 
Route::get('/public', [PublicApiController::class, 'test']);
Route::get('/categories', [PublicApiController::class, 'categories']);


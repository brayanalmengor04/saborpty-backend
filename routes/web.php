<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

// Test Api 
Route::get('/', function () {
    return response()->json(['message' => 'API funcionando']);
});  

//https://saborespty/api/v1/categories 
// Grupo de rutas con prefijo 'api/v1' para versión de la API
Route::prefix('api/v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});
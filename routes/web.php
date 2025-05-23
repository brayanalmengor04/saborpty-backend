<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\RecipeController; 

// Test Api 
Route::get('/', function () {
    return response()->json(['message' => 'API funcionando']);
});  

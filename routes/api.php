<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\CategoryController;
//https://saborespty/api/v1/categories 
// Grupo de rutas con prefijo 'api/v1' para versión de la API
Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class); 
    // Agregar 
    // //https://saborespty/api/v1/recipe/categories{id}/ algo asi esto es para agregar  
    Route::post('/recipes/by-category/{id}', [RecipeController::class, 'storeByCategory']); 
    // GET: Recetas sin relaciones (category_id incluido tal cual)
    Route::get('/recipes', [RecipeController::class, 'getAllRaw']);
    // GET: Recetas con categoryName
    Route::get('/recipes/enriched/all', [RecipeController::class, 'getAllWithCategoryName']);
}); 

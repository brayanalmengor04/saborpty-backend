<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\CategoryController; 
use App\Http\Controllers\Api\IngredientController;


//https://saborespty/api/v1/categories 
// Grupo de rutas con prefijo 'api/v1' para versión de la API
Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class); 
    Route::get('/recipes', [RecipeController::class, 'getAllRaw']);
    Route::get('/recipes/enriched/all', [RecipeController::class, 'getAllWithCategoryName']); 
    Route::post('/recipes/by-category/{id}', [RecipeController::class, 'storeByCategory']);  

    // Filtrados
    Route::get('/recipes/filterby-category/{categoryName}/category',[RecipeController::class, 'getAllWithFilterCategoryName']); 
    Route::get('/recipes/filterby-preparation/asc/{categoryName}/category',[RecipeController::class,'getAllFilterPreparationAscCategory']);
    Route::get('/recipes/filterby-preparation/desc/{categoryName}/category',[RecipeController::class,'getAllFilterPreparationDescCategory']);
    Route::get('/recipes/filterby-rating',[RecipeController::class,'getAllFilterRating']);
    Route::get('/recipes/filterby-recent', [RecipeController::class, 'getAllFilterRecent']);

});  

Route::prefix('v1')->group(function () {
    Route::get('/recipe/{id}/ingredients', [IngredientController::class, 'getIngredientsByRecipe']);
});




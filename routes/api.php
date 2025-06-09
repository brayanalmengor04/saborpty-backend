<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecipeController;
use App\Http\Controllers\Api\CategoryController; 
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\DishIngredientController; 

//https://saborespty/api/v1/categories 
// Grupo de rutas con prefijo 'api/v1' para versión de la API
Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class); 
    Route::get('/recipes', [RecipeController::class, 'getAllRaw']);
    Route::get('/recipes/enriched/all', [RecipeController::class, 'getAllWithCategoryName']); 
    Route::post('/recipes/by-category/{id}', [RecipeController::class, 'storeByCategory']);  
    // Rating
    Route::put('/recipes/{recipeId}/rate', [RecipeController::class, 'rateRecipe']);

    // Filtrados
    Route::get('/recipes/filterby-category/{categoryName}/category',[RecipeController::class, 'getAllWithFilterCategoryName']); 
    Route::get('/recipes/filterby-preparation/asc/{categoryName}/category',[RecipeController::class,'getAllFilterPreparationAscCategory']);
    Route::get('/recipes/filterby-preparation/desc/{categoryName}/category',[RecipeController::class,'getAllFilterPreparationDescCategory']);
    Route::get('/recipes/filterby-rating/{category?}', [RecipeController::class, 'getAllFilterRating']);
    Route::get('/recipes/filterby-recent/{category?}', [RecipeController::class, 'getAllFilterRecent']);

});  
Route::prefix('v1')->group(function () {
    // Route::get('/recipe/{id}/ingredients', [IngredientController::class, 'getIngredientsByRecipe']); 
    // Route::get('/recipe/{id}/ingredients', [IngredientController::class, 'getIngredientsByRecipe']);
   
   Route::get('/dish-ingredients', [DishIngredientController::class, 'index']);
   Route::get('/recipes/{id}/ingredients', [DishIngredientController::class, 'showIngredientsByRecipe']);
});
// Favoritos por usuario firebase
Route::prefix('v1')->group(function () {
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::get('/favorites/{firebase_uid}', [FavoriteController::class, 'getByUser']);
    Route::delete('/favorites/{firebase_uid}/recipe/{recipe_id}', [FavoriteController::class, 'destroy']);
});
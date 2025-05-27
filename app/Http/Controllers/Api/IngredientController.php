<?php

namespace App\Http\Controllers\Api; 
use App\Http\Controllers\Controller; 
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Models\Recipe;

class IngredientController extends Controller
{
  public function getIngredientsByRecipe($id)
    {
        // Obtener receta con ingredientes y categoría
        $recipe = Recipe::with(['ingredients', 'category'])->find($id);
        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }

        return response()->json([
            'recipe' => [
                'id' => $recipe->id,
                'title' => $recipe->title,
                'description' => $recipe->description,
                'duration_minutes' => $recipe->duration_minutes,
                'difficulty' => $recipe->difficulty,
                'rating' => $recipe->rating,
                'image_url' => $recipe->image_url,
                'steps' => $recipe->steps,
                'category_name' => optional($recipe->category)->name, 
            ],
            'ingredients' => $recipe->ingredients
        ]);
    }
}

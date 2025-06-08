<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\DishIngredient;
use Illuminate\Http\Request;

class DishIngredientController extends Controller
{
    public function index()
    {
        $data = DishIngredient::with(['recipe', 'ingredient'])->get();
        return response()->json($data);
    }
    // Mostrar ingredientes de una receta específica
    // public function showIngredientsByRecipe($id)
    // {
    //     $recipe = Recipe::with('ingredients')->find($id);

    //     if (!$recipe) {
    //         return response()->json(['message' => 'Receta no encontrada'], 404);
    //     }

    //     return response()->json([
    //         'recipe' => $recipe->title,
    //         'ingredients' => $recipe->ingredients
    //     ]);
    // }

  public function showIngredientsByRecipe($id)
{
    $recipe = Recipe::with(['ingredients', 'category'])->find($id);

    if (!$recipe) {
        return response()->json(['message' => 'Receta no encontrada'], 404);
    }

    $ingredients = $recipe->ingredients->map(function ($ingredient) {
        return [
            'id' => $ingredient->id,
            'recipe_id' => $ingredient->pivot->recipe_id ?? null,
            'name' => $ingredient->name,
            'icon_url' => $ingredient->icon_url,
            'note' => $ingredient->note,
            'created_at' => $ingredient->created_at ? $ingredient->created_at->toIso8601String() : null,
            'updated_at' => $ingredient->updated_at ? $ingredient->updated_at->toIso8601String() : null,
        ];
    });

    $recipeData = [
        'id' => $recipe->id,
        'title' => $recipe->title,
        'description' => $recipe->description,
        'duration_minutes' => $recipe->duration_minutes,
        'difficulty' => $recipe->difficulty,
        'rating' => (float) $recipe->rating,
        'image_url' => $recipe->image_url,
        'steps' => $recipe->steps,
        'categoryName' => $recipe->category ? $recipe->category->name : null, 
        'youtube_url'=>$recipe->youtube_url,
    ];

    return response()->json([
        'recipe' => $recipeData,
        'ingredients' => $ingredients,
    ]);
}


}

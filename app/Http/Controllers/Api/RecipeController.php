<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    // POST: Crear receta usando category_id por URL (sin validación personalizada)
    public function storeByCategory(Request $request, $id)
    {
        // Asumimos que el frontend está enviando correctamente estos campos
        $recipe = Recipe::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration_minutes' => $request->input('durationMinutes'),
            'difficulty' => strtolower($request->input('difficulty')),
            'rating' => $request->input('rating'),
            'image_url' => $request->input('imageUrl'),
            'category_id' => $id
        ]);

        // Cargar la relación con categoría
        $recipe->load('category');

        return response()->json([
            'id' => $recipe->id,
            'title' => $recipe->title,
            'description' => $recipe->description,
            'categoryName' => $recipe->category->name,
            'durationMinutes' => $recipe->duration_minutes,
            'difficulty' => ucfirst($recipe->difficulty),
            'rating' => $recipe->rating,
            'imageUrl' => $recipe->image_url,
        ], 201);
    } 

    // GET: Todas las recetas (sin relaciones)
    public function getAllRaw()
    {
        return response()->json(Recipe::all());
    }

    // GET: Todas las recetas con categoryName (relación con categoría)
    public function getAllWithCategoryName()
    {
        $recipes = Recipe::with('category')->get()->map(function ($recipe) {
            return [
                'id' => $recipe->id,
                'title' => $recipe->title,
                'description' => $recipe->description,
                'categoryName' => $recipe->category->name,
                'durationMinutes' => $recipe->duration_minutes,
                'difficulty' => strtolower($recipe->difficulty),
                'rating' => $recipe->rating,
                'imageUrl' => $recipe->image_url,
            ];
        });

        return response()->json($recipes);
    }
}

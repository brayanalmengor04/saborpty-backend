<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;  
use App\Models\Activity; 
use App\Models\RecipeRating;
class RecipeController extends Controller
{
    // POST: Crear receta usando category_id por URL (sin validación personalizada)
    public function storeByCategory(Request $request, $id)
    {
        $recipe = Recipe::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration_minutes' => $request->input('durationMinutes'),
            'difficulty' => strtolower($request->input('difficulty')),
            'rating' => $request->input('rating'),
            'image_url' => $request->input('imageUrl'),
            'category_id' => $id
        ]);
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
    public function getAllRaw(){return response()->json(Recipe::all());}
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


    // Sin importar si esta en mayuscula o minuscula
    public function getAllWithFilterCategoryName($categoryName)
    {
    $recipes = Recipe::whereHas('category', function ($query) use ($categoryName) {
        $query->whereRaw('LOWER(name) = ?', [strtolower($categoryName)]);
    })->with('category')->get();

    if ($recipes->isEmpty()) {
        return response()->json(['message' => "Not Found {$categoryName}"], 404);
    }
    $result = $recipes->map(function ($recipe) {
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
    return response()->json($result);
    }

 public function getAllFilterPreparationAscCategory($categoryName)
{
    $recipes = Recipe::whereHas('category', function ($query) use ($categoryName) {
        $query->whereRaw('LOWER(name) = ?', [strtolower($categoryName)]);
    })
    ->with('category')
    ->orderBy('duration_minutes', 'asc')
    ->get();

    if ($recipes->isEmpty()) {
        return response()->json(['message' => "Not Found {$categoryName}"], 404);
    }

    $result = $recipes->map(function ($recipe) {
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

    return response()->json($result);
}

public function getAllFilterPreparationDescCategory($categoryName)
{
    $recipes = Recipe::whereHas('category', function ($query) use ($categoryName) {
        $query->whereRaw('LOWER(name) = ?', [strtolower($categoryName)]);
    })
    ->with('category')
    ->orderBy('duration_minutes', 'desc')
    ->get();

    if ($recipes->isEmpty()) {
        return response()->json(['message' => "Not Found {$categoryName}"], 404);
    }

    $result = $recipes->map(function ($recipe) {
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

    return response()->json($result);
}

public function getAllFilterRating($category = null)
{
    $recipes = Recipe::with('category')
        ->when($category, function ($query) use ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })
        ->orderBy('rating', 'desc')
        ->get();

    if ($recipes->isEmpty()) {
        return response()->json(['message' => 'No recipes found'], 404);
    }
    $result = $recipes->map(function ($recipe) {
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
    return response()->json($result);
}
public function getAllFilterRecent($category = null)
{
    $recipes = Recipe::with('category')
        ->when($category, function ($query) use ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category);
            });
        })
        ->orderBy('created_at', 'desc')
        ->get();

    if ($recipes->isEmpty()) {
        return response()->json(['message' => 'No recipes found'], 404);
    }
    $result = $recipes->map(function ($recipe) {
        return [
            'id' => $recipe->id,
            'title' => $recipe->title,
            'description' => $recipe->description,
            'categoryName' => $recipe->category->name,
            'durationMinutes' => $recipe->duration_minutes,
            'difficulty' => strtolower($recipe->difficulty),
            'rating' => $recipe->rating,
            'imageUrl' => $recipe->image_url,
            'createdAt' => $recipe->created_at->toDateTimeString(),
        ];
    });
    return response()->json($result);
}
public function rateRecipe(Request $request, $recipeId)
{
    $validated = $request->validate([
        'uid' => 'required|string',
        'rating' => 'required|numeric|min:0|max:5',
    ]);
    $recipe = Recipe::find($recipeId);
    if (!$recipe) {
        return response()->json(['message' => 'Recipe not found'], 404);
    }
    RecipeRating::updateOrCreate(
        [
            'recipe_id' => $recipeId,
            'firebase_uid' => $validated['uid'],
        ],
        [
            'rating' => $validated['rating'],
        ]
    );
    $average = RecipeRating::where('recipe_id', $recipeId)->avg('rating');
    $recipe->rating = round($average, 2);
    $recipe->save();
    $recipe->refresh();
    Activity::create([
        'firebase_uid' => $validated['uid'],
        'type' => 'recipe_rate',
        'description' => "Calificaste {$recipe->title} con {$validated['rating']} estrellas.",
        'data' => [
            'recipe_id' => $recipe->id,
            'rating' => $validated['rating'],
            'average' => $recipe->rating,
        ],
    ]);
    return response()->json([
        'message' => 'Rating saved successfully',
        'averageRating' => $recipe->rating,
        'ratingCount' => RecipeRating::where('recipe_id', $recipeId)->count(),
    ]);
}
}

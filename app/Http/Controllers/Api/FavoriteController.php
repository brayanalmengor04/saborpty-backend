<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;  
use App\Models\Favorite;
use Illuminate\Http\Request; 


class FavoriteController extends Controller
{
   // POST: /favorites
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firebase_uid' => 'required|string',
            'recipe_id' => 'required|exists:recipes,id',
        ]);
        $favorite = Favorite::firstOrCreate($validated);
        return response()->json([
            'message' => 'Receta agregada a favoritos',
            'data' => $favorite->load('recipe') // incluye la receta relacionada
        ]);
    }
    // GET: /favorites/{firebase_uid}
    public function getByUser($firebase_uid)
    {
        $favorites = Favorite::with('recipe')
            ->where('firebase_uid', $firebase_uid)
            ->get();
        return response()->json($favorites);
    }
    // DELETE: /favorites/{firebase_uid}/recipe/{recipe_id}
    public function destroy($firebase_uid, $recipe_id)
    {
        $deleted = Favorite::where('firebase_uid', $firebase_uid)
            ->where('recipe_id', $recipe_id)
            ->delete();
        return response()->json([
            'message' => $deleted ? 'Favorito eliminado' : 'Favorito no encontrado',
        ]);
    }
}

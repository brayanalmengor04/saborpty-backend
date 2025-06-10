<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;  
use App\Models\Activity; 
use Illuminate\Http\Request;

class ActivityController extends Controller
{
   public function getByUser($firebase_uid)
{
    $activities = Activity::where('firebase_uid', $firebase_uid)
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($activity) {
            return [
                'id' => $activity->id, 
                'type' => $activity->type,
                'description' => $activity->description,
                'time' => $activity->created_at->diffForHumans(),
            ];
        });
    return response()->json($activities);
}
    public function deleteByUser($firebase_uid)
{
    $deleted = Activity::where('firebase_uid', $firebase_uid)->delete();
    return response()->json([
        'message' => $deleted ? 'Actividades eliminadas correctamente.' : 'No se encontraron actividades para este usuario.',
    ]);
}
public function deleteById($firebase_uid, $id)
{
    $activity = Activity::where('id', $id)
        ->where('firebase_uid', $firebase_uid)
        ->first();
    if (!$activity) {
        return response()->json(['message' => 'Actividad no encontrada o no pertenece a este usuario.'], 404);
    }
    $activity->delete();
    return response()->json(['message' => 'Actividad eliminada correctamente.']);
}

}
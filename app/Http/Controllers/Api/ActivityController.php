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
                'type' => $activity->type,
                'description' => $activity->description,
                'time' => $activity->created_at->diffForHumans(), // Ej: "Hace 2 horas"
            ];
        });

    return response()->json($activities);
}
}
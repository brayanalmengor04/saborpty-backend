<?php

namespace App\Http\Controllers\Api\public;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Category; 

class PublicApiController extends Controller
{
      public function test()
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'API funcionando correctamente',
        ], 200);
    } 

  public function categories()
{
    $categories = Category::all();
    return view('publicTest', compact('categories'));
}
}

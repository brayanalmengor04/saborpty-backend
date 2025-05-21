<?php

namespace App\Http\Controllers\Api\Public;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class PublicApiController extends Controller
{
      public function test()
    {
        return response()->json([
            'status' => 'ok',
            'message' => 'API funcionando correctamente',
        ], 200);
    }
}

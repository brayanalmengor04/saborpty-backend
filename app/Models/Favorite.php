<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;  

class Favorite extends Model
{
     protected $fillable = [
        'firebase_uid',
        'recipe_id',
    ]; 

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

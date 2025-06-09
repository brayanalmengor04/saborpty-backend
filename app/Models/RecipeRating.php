<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe; 

class RecipeRating extends Model
{
    protected $fillable = ['recipe_id', 'firebase_uid', 'rating'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

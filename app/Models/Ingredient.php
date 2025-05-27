<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Recipe;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory; 
    
    protected $fillable = [
        'name',
        'icon_url',
        'note',
        'recipe_id',
    ]; 
    public function recipe()
{
    return $this->belongsTo(Recipe::class);
}
}

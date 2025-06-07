<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;
use App\Models\Ingredient;

class DishIngredient extends Model
{
    protected $table = 'dish_ingredient';

    protected $fillable = ['recipe_id', 'ingredient_id'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}

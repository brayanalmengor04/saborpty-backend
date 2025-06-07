<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon_url', 'note'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'dish_ingredient');
    }
}

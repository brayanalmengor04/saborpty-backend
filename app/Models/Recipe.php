<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory; 
    protected $fillable = [
    'title',
    'description',
    'duration_minutes',
    'difficulty',
    'rating',
    'image_url',
    'category_id',
    ];
    public function category()
    {
    return $this->belongsTo(Category::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DishIngredientSeeder extends Seeder
{
    public function run(): void
    {
        $json = File::get(database_path('data/dishes_ingredient.json'));
        $records = json_decode($json, true);
        foreach ($records as $record) {
            $recipeId = $record['recipe_id'];
            $ingredientIds = $record['ingredient_ids'];

            foreach ($ingredientIds as $ingredientId) {
                DB::table('dish_ingredient')->insert([
                    'recipe_id' => $recipeId,
                    'ingredient_id' => $ingredientId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

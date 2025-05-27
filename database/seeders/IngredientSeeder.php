<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe; 

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $ingredients = [
            [
                'name' => 'Pollo criollo',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/chicken-emoji.png',
                'note' => 'Base proteica del sancocho, preferiblemente con hueso por su sabor.',
            ],
            [
                'name' => 'Ñame',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/roasted-sweet-potato-emoji.png',
                'note' => 'Tubérculo espeso que da cuerpo y textura a la sopa.',
            ],
            [
                'name' => 'Culantro',
                'icon_url' => 'https://img.icons8.com/color/512/415/mint.png',
                'note' => 'Hierba aromática clave para el sabor característico del sancocho.',
            ],
            [
                'name' => 'Ajo',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/garlic-emoji.png',
                'note' => 'Aporta profundidad y aroma al caldo.',
            ],
            [
                'name' => 'Cebolla',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/onion-emoji.png',
                'note' => 'Sofreída o cocida, libera dulzura y aroma.',
            ],
            [
                'name' => 'Ají chombo',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/hot-pepper.png',
                'note' => 'Le da un toque picante y auténtico panameño.',
            ],
            [
                'name' => 'Orégano',
                'icon_url' => 'https://img.icons8.com/color/512/415/basil.png',
                'note' => 'Sazonador seco que potencia el sabor del caldo.',
            ],
            [
                'name' => 'Sal',
                'icon_url' => 'https://img.icons8.com/emoji/512/415/salt-emoji.png',
                'note' => 'Fundamental para resaltar los sabores.',
            ],
            [
                'name' => 'Agua',
                'icon_url' => 'https://img.icons8.com/fluency/512/415/water.png',
                'note' => 'Base líquida del sancocho.',
            ],
            [
                'name' => 'Arroz blanco',
                'icon_url' => 'https://img.icons8.com/color/512/415/rice-bowl.png',
                'note' => 'Acompañamiento tradicional del sancocho.',
            ],
        ];

        $recipe = Recipe::where('title', 'Sancocho Panameño')->first();

        if ($recipe) {
            foreach ($ingredients as $ingredient) {
                $recipe->ingredients()->create($ingredient);
            }
        }
    }
}

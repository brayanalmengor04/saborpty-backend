<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\File; 
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{

     public function run(): void
    {
        $json = File::get(database_path('data/recipes.json'));
        $recipes = json_decode($json, true);
        foreach ($recipes as $recipe) {
            // Codificamos steps en JSON porque la base de datos espera string
            $recipe['steps'] = json_encode($recipe['steps']);
            Recipe::create($recipe);
        }
    }
    // https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_soup_qfffhn.webp 
    /**
     * Run the database seeds.
     */
//     public function run(): void
//     {
//         Recipe::create([
//             'title' => 'Sancocho Panameño',
//             'description' => 'El sancocho panameño es una sopa tradicional hecha con pollo, ñame y un toque característico de culantro. Es considerada uno de los platos más representativos de la cocina panameña.',
//             'duration_minutes' => 90,
//             'difficulty' => 'medium',
//             'rating' => 4.8,
//             'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_soup_qfffhn.webp',
//             'category_id' => 4, 
//             'steps' => json_encode([
//                 'Lavar y cortar el pollo en piezas medianas.',
//                 'Colocar el pollo en una olla grande con suficiente agua.',
//                 'Agregar sal, ajo machacado, cebolla picada y ají chombo.',
//                 'Hervir a fuego medio durante 30 minutos, retirando la espuma que se forma.',
//                 'Añadir el ñame pelado y cortado en trozos medianos.',
//                 'Agregar el orégano seco y cocinar por 25 minutos más.',
//                 'Cuando el ñame esté suave, añadir culantro picado finamente.',
//                 'Rectificar la sal y dejar cocinar por 10 minutos adicionales.',
//                 'Servir caliente, acompañado de arroz blanco si se desea.',
//             ])
//         ]); 
//         Recipe::create([
//         'title' => 'Pizza de Plátano Maduro y Queso Azul',
//         'description' => 'Una fusión inesperada entre lo dulce del plátano maduro y la intensidad del queso azul, horneada sobre una base crujiente de masa artesanal.',
//         'duration_minutes' => 55,
//         'difficulty' => 'hard',
//         'rating' => 3.6,
//         'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_soup_qfffhn.webp',
//         'category_id' => 4, 
//         'steps' => json_encode([
//             'Precalentar el horno a 220°C.',
//             'Extender la masa de pizza sobre una bandeja con papel para hornear.',
//             'Freír ligeramente las rodajas de plátano maduro hasta que estén doradas.',
//             'Cubrir la masa con salsa bechamel o crema ligera.',
//             'Agregar las rodajas de plátano distribuidas uniformemente.',
//             'Desmenuzar el queso azul sobre la pizza.',
//             'Hornear durante 20 minutos hasta que la masa esté dorada.',
//             'Retirar del horno, añadir rúcula fresca y un toque de miel si se desea.',
//             'Servir inmediatamente.'
//     ])
// ]);

//     }
}

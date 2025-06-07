<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Category; 

class CategorySeeder extends Seeder
{ 

 public function run(): void
    {
        $json = File::get(database_path('data/categories.json'));
        $categories = json_decode($json, true);

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
    // Seeder Test Category ----> 
    // public function run(): void
    // {
    //     $categories = [
    //             [
    //                 'name' => 'Traditional',
    //                 'slug' => 'traditional',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787721/category_traditional_idghfz.webp',
    //                 'description' => 'Classic dishes from traditional cuisine.',
    //             ],
    //             [
    //                 'name' => 'Typical Drinks',
    //                 'slug' => 'typical-drinks',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_typicaldrinks_jxepwj.webp',
    //                 'description' => 'Popular local and cultural beverages.',
    //             ],
    //             [
    //                 'name' => 'Seafood',
    //                 'slug' => 'seafood',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_seafood_hwg6bw.webp',
    //                 'description' => 'Delicious dishes made with fresh seafood.',
    //             ],
    //             [
    //                 'name' => 'Soup',
    //                 'slug' => 'soup',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_soup_qfffhn.webp',
    //                 'description' => 'Warm and comforting soups for every taste.',
    //             ],
    //             [
    //                 'name' => 'Desserts',
    //                 'slug' => 'desserts',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_desserts_adwwgp.webp',
    //                 'description' => 'Sweet treats to finish your meal.',
    //             ],
    //             [
    //                 'name' => 'Quick Dishes',
    //                 'slug' => 'quick-dishes',
    //                 'image_url' => 'https://res.cloudinary.com/dv5ruetn7/image/upload/v1747787720/category_quicksdishes_x0g7v4.webp',
    //                 'description' => 'Fast and easy meals for busy days.',
    //             ],
    //         ]; 


    //         foreach ($categories as $category) {
    //           Category::create($category);
    //       }
    //     }
    }

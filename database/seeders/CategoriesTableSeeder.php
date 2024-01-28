<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()->count(5)->create();
        $categories = [
            'الألبان والبيض',  // Dairy and Eggs
            'المشروبات',       // Beverages
            'المخبوزات',       // Bakery
            'الفواكه والخضروات', // Fruits and Vegetables
            'اللحوم والأسماك',   // Meat and Seafood
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }
}

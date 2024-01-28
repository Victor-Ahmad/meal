<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SubCategory::factory()->count(15)->create();
        $subCategories = [
            ['name' => 'حليب', 'category' => 'الألبان والبيض'],    // Milk
            ['name' => 'جبن', 'category' => 'الألبان والبيض'],     // Cheese
            ['name' => 'مياه', 'category' => 'المشروبات'],         // Water
            ['name' => 'عصائر', 'category' => 'المشروبات'],       // Juices
            ['name' => 'خبز', 'category' => 'المخبوزات'],          // Bread
            ['name' => 'كعك', 'category' => 'المخبوزات'],          // Cakes
            ['name' => 'فواكه', 'category' => 'الفواكه والخضروات'], // Fruits
            ['name' => 'خضروات', 'category' => 'الفواكه والخضروات'], // Vegetables
            ['name' => 'لحوم', 'category' => 'اللحوم والأسماك'],    // Meats
            ['name' => 'أسماك', 'category' => 'اللحوم والأسماك'],   // Seafood
        ];

        foreach ($subCategories as $subCategory) {
            $category = Category::where('name', $subCategory['category'])->first();

            if ($category) {
                SubCategory::updateOrCreate(
                    ['name' => $subCategory['name'], 'category_id' => $category->id],
                    ['slug' => Str::slug($subCategory['name'])]
                );
            }
        }
    }
}

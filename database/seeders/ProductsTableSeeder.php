<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Product::factory()->count(30)->create();
        $products = [
            ['name' => 'حليب كامل الدسم', 'sub_category' => 'حليب'],
            ['name' => 'حليب خالي من الدسم', 'sub_category' => 'حليب'],
            ['name' => 'جبنة شيدر', 'sub_category' => 'جبن'],
            ['name' => 'جبنة موزاريلا', 'sub_category' => 'جبن'],
            ['name' => 'ماء معدني', 'sub_category' => 'مياه'],
            ['name' => 'مياه غازية', 'sub_category' => 'مياه'],
            ['name' => 'عصير برتقال طبيعي', 'sub_category' => 'عصائر'],
            ['name' => 'عصير تفاح', 'sub_category' => 'عصائر'],
            ['name' => 'خبز أبيض', 'sub_category' => 'خبز'],
            ['name' => 'خبز الحبوب الكاملة', 'sub_category' => 'خبز'],
            ['name' => 'كعكة الشوكولاتة', 'sub_category' => 'كعك'],
            ['name' => 'كعكة الفانيلا', 'sub_category' => 'كعك'],
            ['name' => 'تفاح أخضر', 'sub_category' => 'فواكه'],
            ['name' => 'موز', 'sub_category' => 'فواكه'],
            ['name' => 'بطاطس', 'sub_category' => 'خضروات'],
            ['name' => 'طماطم', 'sub_category' => 'خضروات'],
            ['name' => 'دجاج كامل', 'sub_category' => 'لحوم'],
            ['name' => 'لحم بقري', 'sub_category' => 'لحوم'],
            ['name' => 'سمك السلمون', 'sub_category' => 'أسماك'],
            ['name' => 'جمبري', 'sub_category' => 'أسماك'],
            ['name' => 'زبادي طبيعي', 'sub_category' => 'حليب'],
            ['name' => 'قهوة عربية', 'sub_category' => 'مياه'],
            ['name' => 'تمر', 'sub_category' => 'فواكه'],
            ['name' => 'خيار', 'sub_category' => 'خضروات'],
            ['name' => 'لحم غنم', 'sub_category' => 'لحوم']
        ];
        $faker = Faker::create();
        $companyIds = Company::pluck('id')->toArray(); 
        foreach ($products as $productData) {
            $subCategory = SubCategory::where('name', $productData['sub_category'])->first();

            if ($subCategory) {
                Product::create([
                    'name' => $productData['name'],
                    'price' => $faker->randomFloat(2, 1, 1000), // Random price between 1 and 1000
                    'amount' => $faker->numberBetween(0, 100),  
                    'sub_category_id' => $subCategory->id,
                    'category_id' => $subCategory->category_id,
                    'company_id' => Arr::random($companyIds),
                    'slug' => Str::slug($productData['name']),
                ]);
            }
        }
    }
}

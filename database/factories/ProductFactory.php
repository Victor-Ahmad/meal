<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        $category = Category::inRandomOrder()->first() ?? Category::factory()->create();
        $subCategory = SubCategory::where('category_id', $category->id)->inRandomOrder()->first() ?? SubCategory::factory()->create(['category_id' => $category->id]);
        $name = $this->faker->unique()->word;
        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($name),
            'price' => $this->faker->randomFloat(2, 1, 1000), // Generate a random price between 1 and 1000
            'amount' => $this->faker->numberBetween(0, 100), // Generate a random amount
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
        ];
    }
}

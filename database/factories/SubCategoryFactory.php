<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    protected $model = SubCategory::class;

    public function definition()
    {
        $name = $this->faker->unique()->word;
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory()->create()->id,
            'name' => $this->faker->word,
            'slug' => Str::slug($name),
            // Add other fields as needed
        ];
    }
}

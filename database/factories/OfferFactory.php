<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure there's at least one product to assign to the offer
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        // Ensure offer price is less than the product price
        $offerPrice = $this->faker->randomFloat(2, 1, $product->price - 0.01); // Set max to just below product price

        return [
            'name' => $this->faker->words(3, true), // Generate a random name
            'offer_price' => $offerPrice,
            'amount' => $this->faker->numberBetween(1, 100), // Generate a random amount
            'product_id' => $product->id, // Associate the offer with a product
        ];
    }
}

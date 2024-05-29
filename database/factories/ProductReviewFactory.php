<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductReview>
 */
class ProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => random_int(1, 7),
            'user_id' => random_int(1, 9),
            'rating' => fake()->numberBetween(1, 5),
            'comment' => fake()->paragraph(3),
            'status' => 2
        ];
    }
}

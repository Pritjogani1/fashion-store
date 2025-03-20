<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            // 'name' => $this->faker->word(),
            // 'slug' => $this->faker->slug(),
            // 'description' => $this->faker->paragraph(),
            // 'price' => $this->faker->randomFloat(2, 10, 500),
            // 'status' => $this->faker->randomElement(['available', 'out_of_stock']),
        ];
    }
}

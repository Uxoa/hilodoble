<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'itemName' => $this->faker->word(),
            'category' => $this->faker->word(),
            'description' => $this->faker->realText(),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'stockQuantity' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
            'purchaseQuantity' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
            'price' => $this->faker->biasedNumberBetween($min = 1, $max = 10, $function = 'sqrt'),
        ];
    }
}

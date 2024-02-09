<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'label' => 'produk '.fake()->numberBetween(1,20),
            'image' => 'bg1.jpg',
            'price' => fake()->numberBetween(10000,200000),
            'stock' => fake()->numberBetween(1,20),
            'deskripsi' => fake()->paragraphs(10, true),
            'views' => fake()->numberBetween(100,1000)
        ];
    }
}

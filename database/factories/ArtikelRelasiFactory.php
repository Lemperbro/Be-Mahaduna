<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtikelRelasi>
 */
class ArtikelRelasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artikel_id' => fake()->numberBetween(1,10),
            'artikel_kategori_id' => fake()->numberBetween(1,4)
        ];
    }
}

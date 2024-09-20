<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtikelKategori>
 */
class ArtikelKategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kategori' => fake()->unique()->randomElement(['Teknologi', 'Sosial', 'Pemerintahan', 'Ekonomi']),
            'user_created' => 1,
            'updated_at' => null
        ];
    }
}

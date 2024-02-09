<?php

namespace Database\Factories;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->unique()->name,
            'nisn' => fake()->unique()->numberBetween(100000,999999),
            'jenjang' => 'Senior',
            'tgl_masuk' => fake()->date('Y-m-d'),
        ];
    }
}

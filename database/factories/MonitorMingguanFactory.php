<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonitorMingguan>
 */
class MonitorMingguanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'santri_id' => fake()->unique(true)->numberBetween(1,10),
            'hadir' => fake()->numberBetween(1,15),
            'tidak_hadir' => fake()->numberBetween(1,15),
            'terlambat' => fake()->numberBetween(1,15),
            'kategori' => fake()->randomElement(['sholat jamaah', 'ngaji'])
        ];
    }
}

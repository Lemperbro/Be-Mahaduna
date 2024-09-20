<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jenjang>
 */
class JenjangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenjang = [
            'mts',
            'ma',
        ];
        return [
            'jenjang' => fake()->unique()->randomElement($jenjang)
        ];
    }
}

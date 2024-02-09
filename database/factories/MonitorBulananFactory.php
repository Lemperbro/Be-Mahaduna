<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonitorBulanan>
 */
class MonitorBulananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $progres = ['Sudah hafal surat An-baqarah ayat 1-20', 'Sudah hafal surat An-baqarah ayat 20-40', 'Sudah hafal surat An-baqarah ayat 40-80', 'Sudah hafal surat An-baqarah ayat 80-120'];
        return [
            'santri_id' => fake()->unique(true)->numberBetween(1,10),
            'progres' => fake()->randomElement($progres),
            'bulan' => now()
        ];
    }
}

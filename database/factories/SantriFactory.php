<?php

namespace Database\Factories;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    public static $counter = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this::$counter += 1;
        return [
            'nama' => fake()->unique()->name,
            'jenjang_id' => fake()->randomElement([1,2]),
            'status' => $this::$counter % 2 == 0 ? 'lulus' : 'aktif',
            'jenis_kelamin' => fake()->randomElement(['laki-laki', 'perempuan']),
            'tgl_lahir' => fake()->date('Y-m-d'),
            'tgl_keluar' => $this::$counter % 2 == 0 ? now() : null
        ];
    }
}

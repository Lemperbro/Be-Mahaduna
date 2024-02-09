<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wali>
 */
class WaliFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->email,
            'password' => Hash::make('12345678'),
            'nama' => fake()->unique()->name,
            'alamat' => fake()->address,
            'telp' => fake()->phoneNumber,
        ];
    }
}

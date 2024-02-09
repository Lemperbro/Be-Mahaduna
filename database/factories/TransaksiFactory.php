<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tagihan_id' => fake()->numberBetween(1,10),
            'invoice_id' => strtolower(fake()->iban()),
            'price' => fake()->numberBetween(1000,9999).'000',
            'payment_status' => fake()->randomElement(['PAID', 'PENDING', 'EXPIRED']),
        ];
    }
}

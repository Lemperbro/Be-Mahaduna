<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
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
                'santri_id' => fake()->unique(true)->numberBetween(1, 20),
                'admin_id' => fake()->numberBetween(1, 4),
                'label' => 'Tagihan Pembayaran Bulan Februari',
                'price' => 250000,
                'date' => fake()->unique(true)->date(),
                'status' => $this::$counter % 2 == 0 ? 'sudah dibayar' : 'belum dibayar' ,
                'payment_type' => $this::$counter % 2 ==0 ? fake()->unique()->randomElement(['cash', 'transfer']) : null,
            ];
    }
}

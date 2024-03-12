<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{

    public static $counter = 0;
    public static $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this::$counter += 1;
        $paymentStatusOptions = ['belum dibayar', 'menunggu dibayar'];
        if ($this::$counter % 2 == 1) {
            if ($this::$index > 1) {
                $this::$index = 0;
            }
            $index = $this::$index;
            $this::$index += 1;
        }

        return [
            'santri_id' => fake()->unique(true)->numberBetween(1, 20),
            'label' => 'Tagihan Pembayaran Bulan Februari',
            'price' => $this::$counter % 2 == 0 ? 2500000 : 10000,
            'date' => fake()->unique(true)->date(),
            'status' => $this::$counter % 2 == 0 ? 'sudah dibayar' : $paymentStatusOptions[$index],
            'payment_type' => $this::$counter % 2 == 0 ? fake()->unique()->randomElement(['cash', 'transfer']) : null,
        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
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
        $paymentStatusOptions = ['EXPIRED', 'PENDING'];
        if ($this::$counter % 2 == 1) {
            if ($this::$index > 1) {
                $this::$index = 0;
            }
            $index = $this::$index;
            $this::$index += 1;
        }

        return [
            'tagihan_id' => $this::$counter,
            'invoice_id' => strtolower(fake()->iban()),
            'external_id' => strtolower(fake()->iban()),
            'payment_link' => 'https://ryandev.biz.id',
            'payment_type' => 'payment_gateway',
            'price' => $this::$counter % 2 == 0 ? 2500000 : 10000,
            'pay' => $this::$counter % 2 == 0 ? 2500000 : null,
            'payment_status' => $this::$counter % 2 == 0 ? 'PAID' : $paymentStatusOptions[$index],
            'expired' => now()
        ];
    }
}

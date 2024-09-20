<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreImage>
 */
class StoreImageFactory extends Factory
{
    private static $index = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$index++;

        return [
            'store_id' => ceil(self::$index / 2),
            'image' => 'uploads/storeImage/default.jpg'
        ];
    }
}

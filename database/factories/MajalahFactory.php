<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Majalah>
 */
class MajalahFactory extends Factory
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
            'judul' => fake()->sentence(),
            'source' => 'default'.self::$index.'.pdf',
            'bannerImage' => 'https://qomaruddinpd.com/uploads/majalahImage/bg.jpg',
            'views' => fake()->numberBetween(100,1000)
        ];
    }
}

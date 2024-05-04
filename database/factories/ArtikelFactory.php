<?php

namespace Database\Factories;

use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artikel>
 */
class ArtikelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(),
            'bannerImage' => 'https://qomaruddinpd.com/uploads/artikelImage/bg.jpg',
            'isi' => fake()->paragraphs(10, true),
            'views' => fake()->numberBetween(100,1000),
            'user_created' => 1,
            'updated_at' => null
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlaylistVideo>
 */
class PlaylistVideoFactory extends Factory
{
    private static $index = -1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$index++;
        $playlistId = [
            'PLyLuyxntIy4XOR7OrbNljzqK7Y0g-Th30',
            'PLyLuyxntIy4XwbfSh8RFgoQIY4bkW_yC-',
            'PLyLuyxntIy4UWstzHUyqXRn_-gPMYm4HI',
            'PLyLuyxntIy4UX8pHs6Ftt5BzleNxpLfMi'
        ];
        return [
            'playlistId' => $playlistId[self::$index]
        ];
    }
}

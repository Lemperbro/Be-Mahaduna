<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jadwal>
 */
class JadwalFactory extends Factory
{

    private static $countHour = 0;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$countHour++;
        //kalau add perjam addHours()
        $startTime = Carbon::now()->addMinutes(self::$countHour);
        $endTime = Carbon::parse($startTime)->addMinutes(1);
        return [
            'jadwal' => fake()->randomElement(['ngaji', 'istirahat', 'makan','tidur']),
            'start_time' => $startTime,
            'end_time' => $endTime
            
        ];
    }
}

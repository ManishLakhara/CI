<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeMission>
 */
class TimeMissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_seats' => $this->faker->randomNumber(3),
            'registration_deadline' => $this->faker->date(Carbon::now()->addDays(10)),
        ];
    }
}

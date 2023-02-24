<?php

namespace Database\Factories;

use Carbon\Traits\ToStringFormat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'theme_id' => $this->faker->numberBetween(1,200),
            'title' => $this->faker->words(4,true),
            'short_description' => $this->faker->words(10,true),
            'description' => $this->faker->sentence(3),
            'mission_type' => $this->faker->randomElement(['GOAL','TIME']),
            'status'=> $this->faker->numberBetween(0,1),
        ];
    }
}

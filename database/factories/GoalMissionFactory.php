<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Mission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoalMission>
 */
class GoalMissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'goal_value' => $this->faker->numberBetween(500,700),
            'goal_objective_text' => $this->faker->words(5,true),
        ];
    }
}

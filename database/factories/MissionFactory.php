<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\MissionTheme;
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
        $cities = City::where('country_id','=',167)->pluck('city_id')->toArray();
        $theme_ids = MissionTheme::all()->pluck('mission_theme_id')->toArray();
        return [
            'theme_id' => $this->faker->randomElement($theme_ids),
            'title' => $this->faker->words(5,true),
            'short_description' => $this->faker->words(30,true),
            'description' => $this->faker->sentence(10),
            'mission_type' => $this->faker->randomElement(['GOAL','TIME']),
            'status'=> $this->faker->numberBetween(0,1),
            'country_id'=> '167',
            'city_id' => $this->faker->randomElement($cities),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'availability' => $this->faker->randomElement(['daily', 'weekly', 'week-end', 'monthly']),
            'organization_detail' => $this->faker->sentence(6),
            'organization_name' => $this->faker->words(3,true),
        ];
    }
}

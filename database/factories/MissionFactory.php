<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\MissionTheme;
use Carbon\Carbon;
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
        $countries = Country::get()->pluck('country_id');
        $country = $this->faker->randomElement($countries);
        $cities = City::where('country_id',$country)->get()->pluck('city_id');
        $theme_ids = MissionTheme::all()->pluck('mission_theme_id')->toArray();
        return [
            'theme_id' => $this->faker->randomElement($theme_ids),
            'title' => $this->faker->words(5,true),
            'short_description' => $this->faker->words(30,true),
            'description' => $this->faker->sentence(10),
            'mission_type' => $this->faker->randomElement(['GOAL','TIME']),
            'status'=> $this->faker->numberBetween(0,1),
            'country_id' => $country,
            'city_id' => $this->faker->randomElement($cities),
            'start_date' => $this->faker->dateTimeBetween('now'),
            'end_date' => $this->faker->dateTimeBetween('now','+15 days'),
            'availability' => $this->faker->randomElement(['daily', 'weekly', 'week-end', 'monthly']),
            'organization_detail' => $this->faker->sentence(100),
            'organization_name' => $this->faker->words(3,true),
        ];
    }
}

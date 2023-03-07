<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
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
        $countries = Country::all()->pluck('country_id')->toArray();
        $country = fake()->randomElement($countries);
        $cities = City::where('country_id',$country)
                        ->pluck('city_id')
                        ->toArray();
                        
        return [
            'theme_id' => $this->faker->numberBetween(1,200),
            'title' => $this->faker->words(4,true),
            'short_description' => $this->faker->words(10,true),
            'description' => $this->faker->sentence(3),
            'mission_type' => $this->faker->randomElement(['GOAL','TIME']),
            'status'=> $this->faker->numberBetween(0,1),
            'country_id'=> $country,
            'city_id' => $this->faker->randomElement($cities),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'availability' => $this->faker->randomElement(['daily', 'weekly', 'week-end', 'monthly']),
            'organization_detail' => $this->faker->sentence(),
            'organization_name' => $this->faker->words(3,true),
        ];
    }
}

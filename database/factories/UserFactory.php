<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
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
            'first_name' => fake()->firstname(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'employee_id' => fake()->unique()->randomNumber(9),
            'department' => fake()->randomElement(['HR', 'SALES', 'DEVELOPER', 'DEPLOYER', 'MANAGER']),
            'status' => fake()->numberBetween(0,1),
            'password' => bcrypt('12345678'), //passsword
            'phone_number' => fake()->randomNumber(9),
            'profile_text' => fake()->sentence(3),
            'title' => fake()->words(6,true),
            'country_id' => $country,
            'city_id' => fake()->randomElement($cities),
            'avatar' => fake()->randomElement(['Images/volunteer1.png',
            'Images/volunteer2.png',
            'Images/volunteer3.png',
            'Images/volunteer4.png',
            'Images/volunteer5.png',
            'Images/volunteer6.png',
            'Images/volunteer7.png',
            'Images/volunteer8.png',
            'Images/volunteer9.png',
        ]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

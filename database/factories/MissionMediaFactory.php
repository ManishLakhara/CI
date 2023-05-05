<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MissionMedia>
 */
class MissionMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'media_name' => $this->faker->word(),
            'media_path' => $this->faker->randomElement([
                'Images/Animal-welfare-&-save-birds-campaign-1.png',
                'Images/Grow-Trees-On-the-path-to-environment-sustainability-2.png',
                'Images/img2.png',
                'Images/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-2.png',
                'Images/Nourish-the-Children-in--African-country.png',
                'Images/img22.png',
                'Images/Education-Supplies-for-Every--Pair-of-Shoes-Sold-1.png',
                'Images/Plantation-and-Afforestation-programme-1.png',
            ]),
            'media_type' => 'png',
        ];
    }
}

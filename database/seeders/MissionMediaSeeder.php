<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\MissionMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissionMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paths = [
            'mission_media/Animal-welfare-&-save-birds-campaign-1.png',
            'mission_media/Grow-Trees-On-the-path-to-environment-sustainability-2.png',
            'mission_media/img2.png',
            'mission_media/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-2.png',
            'mission_media/Nourish-the-Children-in--African-country.png',
            'mission_media/img22.png',
            'mission_media/Education-Supplies-for-Every--Pair-of-Shoes-Sold-1.png',
            'mission_media/Plantation-and-Afforestation-programme-1.png'
        ];
        $mission_ids = Mission::all()->pluck('mission_id');
        foreach ($mission_ids as $mission_id){
            MissionMedia::create([
                'mission_id' => $mission_id,
                'default' => '1',
                'media_name' => fake()->word(),
                'media_type' => 'png',
                'media_path' => fake()->randomElement($paths)
            ]);
        }
    }
}

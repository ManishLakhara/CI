<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\StoryMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoryMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $story_ids = Story::all()->pluck('story_id');
        $paths = [
            'storage/story_media/CSR-initiative-stands-for-Coffee--and-Farmer-Equity-2.png',
            'storage/story_media/Education-Supplies-for-Every--Pair-of-Shoes-Sold-1.png',
            'storage/story_media/Grow-Trees-On-the-path-to-environment-sustainability-4.png',
            'storage/story_media/Nourish-the-Children-in--African-country-1.png',
            'storage/story_media/Plantation-and-Afforestation-programme-1.png',
            'storage/story_media/image.png',
            'storage/story_media/img22.png',
            'storage/story_media/img33.png',
        ];
        foreach ($story_ids as $story_id) {
            for ($i=5; $i > 0; $i--) {
                StoryMedia::create([
                    'story_id' => $story_id,
                    'type' => 'png',
                    'path' => fake()->randomElement($paths),
                ]);
            }
        }
    }
}

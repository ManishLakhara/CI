<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\MissionRating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissionRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missions_a = Mission::all()->pluck('mission_id');
        foreach ($missions_a as $mission_id) {
            $users_a = MissionApplication::where('mission_id','=',$mission_id)
                                        ->get()->pluck('user_id');
            for($i=3;$i>0;$i--){
                MissionRating::create([
                    'mission_id' => $mission_id,
                    'user_id' => fake()->randomElement($users_a),
                    'rating' => fake()->randomElement(['1','2','3','4','5']),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\GoalMission;
use App\Models\Mission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class GoalMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $ids = Mission::whereMissionType('GOAL')->get()->pluck('mission_id');
        // $array = [];
        // foreach ($ids as $id) {
        //     array_push($array,[
        //         'goal_value' => fake()->numberBetween(3000,8000),
        //         'goal_objective_text' => fake()->words(7,true),
        //         'mission_id' => $id,
        //     ]);
        // }

        // GoalMission::create($array);
        foreach ($ids as $id) {
            GoalMission::create([
                'goal_value' => fake()->numberBetween(3000,8000),
                'goal_objective_text' => fake()->words(7,true),
                'mission_id' => $id,
            ]);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\MissionApplication;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissionApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $missions = Mission::all()->pluck('mission_id');
        $users = User::all()->pluck('user_id');
        foreach ($missions as $mission) {
            for($i=25;$i>0;$i--){
                MissionApplication::create([
                    'mission_id' => $mission,
                    'user_id' => fake()->randomElement($users),
                    'approval_status' => 'APPROVE',
                ]);
            }
        }
    }
}

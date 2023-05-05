<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\GoalMission;
use App\Models\Mission;
use App\Models\MissionMedia;
use App\Models\MissionSkill;
use App\Models\MissionTheme;
use App\Models\Skill;
use App\Models\TimeMission;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $countries = Country::factory(5)
                    ->create()
                    ->each(function($country){
                        City::factory(5)
                        ->create([
                            'country_id' => $country->country_id,
                        ]);
                    });
        $users = User::factory(10)->create();
        $themes  = MissionTheme::factory(10)->create();
        $skills = Skill::factory(10)->create()->pluck('skill_id');
        $missions = Mission::factory(20)
        ->create()
        ->each(function($mission){
            for($i=1;$i<=5;$i++){
                MissionMedia::factory()->create([
                    'default' => $i==1?'1':'0',
                    'mission_id' => $mission->mission_id,
                ]);
            }
            if($mission->mission_type=='GOAL'){
                GoalMission::factory()->create([
                    'mission_id' => $mission->mission_id,
                ]);
            } else {
                TimeMission::factory()->create([
                    'mission_id' => $mission->mission_id,
                ]);
            }
            $skills = Skill::get()->pluck('skill_id');
            for($i=mt_rand(1,3);$i>0;$i--){
                MissionSkill::create([
                    'mission_id' => $mission->mission_id,
                    'skill_id' => fake()->randomElement($skills),
                ]);
            }
        });
    }
}

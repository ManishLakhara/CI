<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\TimeMission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ids = Mission::whereMissionType('TIME')->get()->pluck('mission_id');

        foreach($ids as $id){
            TimeMission::create([
                'mission_id' => $id,
                'registration_deadline' => fake()->date(),
                'total_seats' => fake()->numberBetween(20,40),
            ]);
        }
    }
}

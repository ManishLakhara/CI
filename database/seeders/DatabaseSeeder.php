<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
<<<<<<< Updated upstream

=======
        
>>>>>>> Stashed changes
        $this->call([
            //CountrySeeder::class,
            //CitySeeder::class,
            SkillSeeder::class,
            MissionThemeSeeder::class,
            MissionSkillSeeder::class,
            UserSeeder::class,
            MissionSeeder::class,
            GoalMissionSeeder::class,
            TimeMissionSeeder::class,
            MissionApplicationSeeder::class,
            CommentSeeder::class,
            MissionRatingSeeder::class,
            StorySeeder::class,
            StoryMediaSeeder::class,
        ]);
    }
}

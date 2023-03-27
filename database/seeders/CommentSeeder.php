<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mission_ids = Mission::all()->pluck('mission_id');
        $users = User::all()->pluck('user_id');
        foreach ($mission_ids as $mission_id) {
            for($i=4;$i>0;$i--){
                Comment::create([
                    'user_id'=> fake()->randomElement($users),
                    'text' => fake()->words(10,true),
                    'mission_id' => $mission_id,
                    'approval_status' => 'PUBLISHED',
                ]);
            }
        }
    }
}

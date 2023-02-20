<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/MigrateInOrder.php \n Drop all the table in db before execute the command.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $migrations = [
            '2023_02_20_101221_create_user_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
            '2019_12_14_000001_create_personal_access_tokens_table.php',
            '2023_02_20_053054_create_admins_table.php', 
            '2023_02_20_053350_create_banners_table.php', 
            '2023_02_20_053436_create_countries_table.php', 
            '2023_02_20_053406_create_cities_table.php', 
            '2023_02_20_053927_create_mission_themes_table.php',
            '2023_02_20_053740_create_missions_table.php',  
            '2023_02_20_080253_story.php',
            '2023_02_20_063229_user.php', 
            '2023_02_20_053830_create_mission_invites_table.php',            
            '2023_02_20_053846_create_mission_media_table.php',            
            '2023_02_20_053901_create_mission_ratings_table.php',          
            '2023_02_20_053915_create_mission_skills_table.php',                            
            '2023_02_20_053945_create_password_resets_table.php',               
            '2023_02_20_053959_create_skills_table.php',
            '2023_02_20_053421_create_comments_table.php',
            '2023_02_20_054015_create_stories_table.php',             
            '2023_02_20_054031_create_story_invites_table.php',
            '2023_02_20_053533_create_cms_pages_table.php',               
            '2023_02_20_054045_create_story_media_table.php',
            '2023_02_20_053645_create_favourite_missions_table.php',     
            '2023_02_20_054100_create_timesheets_table.php',
            '2023_02_20_053724_create_goal_missions_table.php',      
            '2023_02_20_054132_create_user_skills_table.php', 
            '2023_02_20_053756_create_mission_applications_table.php', 
            '2023_02_20_053816_create_mission_documents_table.php',
        ];
        foreach($migrations as $migration)
        {
           $basePath = 'database\\migrations\\';          
           $migrationName = trim($migration);
           $path = $basePath.$migrationName;
           $this->call('migrate:refresh', [
            '--path' => $path,
           ]);
        }
    }
}
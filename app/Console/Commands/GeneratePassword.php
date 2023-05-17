<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneratePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $length = 12;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-={}[]|\:;"<>,.?/~`';
        $password = '';

        // Generate a password that includes at least one uppercase letter, one lowercase letter, one number, and one special character
        do {
            $password = '';
            for ($i = 0; $i < $length; $i++) {
                $password .= $chars[rand(0, strlen($chars) - 1)];
            }
        } while (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/', $password));


        $this->info("Your generated password is: $password");
        Log::info("Your generated password is: $password");
        // $tables = DB::select('SHOW TABLES');

        // foreach ($tables as $table) {
        //     $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
        //     $columns = DB::select("SHOW COLUMNS FROM $tableName");

        //     $this->info('Table: ' . $tableName);
        //     foreach ($columns as $column) {
        //         $this->info('- ' . $column->Field);
        //     }
        //     $this->info('------------------------');
        // }
    }
}

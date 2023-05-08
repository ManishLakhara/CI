<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating cron Lob to update laravel.log file with log';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        \Log::info("Cron have been running!");
    }
}

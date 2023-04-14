<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetTokenExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "delete:oldrows";
    protected $description = 'Deleted rows from reset password table when token expire';
    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $fourHoursAgo = Carbon::now()->subHour(1);
        DB::table('password_resets')->where('created_at','<',$fourHoursAgo)->delete();
        $this->info("Old rows have successfully deleted!");
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CronController;

class RentExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rent:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'When User Rent has expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $messaging = new CronController();
        Log::info('Cron Job Start Checking Expired Rent');
        // $do = $messaging->fire();
        $do = $messaging->rentExpired();
        Log::info($do);
        Log::info('Cron Job Ended Checking Expired Rent');
        
        return $this->info($do);
        
    }
}

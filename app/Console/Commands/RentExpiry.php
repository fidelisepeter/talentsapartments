<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CronController;

class RentExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rent:expiring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Resident on Rent expiration';

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
        Log::info('Cron Job Start Checking Rent expiration');
        $messaging = new CronController();
        // $do = $messaging->fire();
        $do = $messaging->rentExpiringIn(65);
        Log::info($do);
        Log::info('Cron Job Ended Checking Rent expiration');
        return $this->info($do);
        
    }
}

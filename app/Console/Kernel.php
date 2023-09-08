<?php

namespace App\Console;

use App\Console\Commands\RentExpired;
use App\Console\Commands\RentExpiry;
use App\Models\Rent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    
    protected $commands = [
        RentExpiry::class,
        RentExpired::class,
       ]; 
    
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('notification:rent')->weekly();
        //One hour is added to compensate for PHP being one hour faster
       
        $schedule->command('rent:expiring')->weeklyOn(6, '10:00');
        
        $schedule->command('rent:expired')->dailyAt('10:00');
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

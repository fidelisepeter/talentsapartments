<?php

namespace Illuminate\Console\Scheduling;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ScheduleWorkCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'schedule:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the schedule worker';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Schedule worker started successfully.');

        Log::info('Schedule worker started successfully.');
        while (true) {
            if (now()->second === 0) {
                $this->call('schedule:run');
            }

            sleep(1);
        }
    }
}

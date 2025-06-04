<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('sitemanager:document-status-change')->twiceDaily(1, 13);
        $schedule->command('sitemanager:suboperative-document-status-change')->twiceDaily(2, 14);
        $schedule->command('sitemanager:training-status-change')->twiceDaily(2, 14);
        $schedule->command('sitemanager:project-status-change')->daily();
        $schedule->command('sitemanager:suboperative-status-change')->daily();

        // $schedule->command('sitemanager:change-assignment-status')->twiceDaily(3, 15);


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

<?php

namespace App\Console;

use App\Console\Commands\EveryDay;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        EveryDay::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('everyday:mail')->everyMinute();
        // $schedule->command('inspire')
        //          ->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

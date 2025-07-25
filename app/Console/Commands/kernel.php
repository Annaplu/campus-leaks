<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('scrape:metanoiac')->dailyAt('07:00'); // Jalankan setiap jam 7 pagi
    }
}

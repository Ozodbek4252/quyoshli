<?php

namespace App\Console;

use App\Jobs\Cron\CloseOrderJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\Cron\BackProductJob;
use App\Jobs\Cron\SendSmsJob;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new BackProductJob)->everyMinute()->timezone('Asia/Tashkent')->withoutOverlapping();
        $schedule->job(new SendSmsJob)->everyMinute()->timezone('Asia/Tashkent')->withoutOverlapping();
        $schedule->job(new CloseOrderJob())->everyMinute()->timezone('Asia/Tashkent')->withoutOverlapping();
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

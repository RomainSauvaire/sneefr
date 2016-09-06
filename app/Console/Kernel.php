<?php

namespace Sneefr\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Sneefr\Console\Commands\ClearAlgoliaIndex::class,
        \Sneefr\Console\Commands\InitAlgoliaIndices::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Very frequent calls

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\SendWaitingMessageEmail'));
        })->everyTenMinutes();

        // Keep it synced with 10 minutes job's expiration date
        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\SendExpiringLocks'));
        })->everyTenMinutes();

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\RemoveExpiredLocks'));
        })->everyTenMinutes();

        // Calls made every hour

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\BackupDatabase'));
        })->hourly();

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\DeleteOutdatedTemporaryImages'));
        })->hourly();

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\ForceOutdatedEvaluations'));
        })->hourly();

        // Daily calls

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\SendWaitingNotificationEmail'));
        })->dailyAt('18:30');

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\RemoveOutdatedDatabaseDumps'));
        })->dailyAt('04:00');

        $schedule->call(function () {
            app('Illuminate\Contracts\Bus\Dispatcher')
                ->dispatch(app('Sneefr\Jobs\ImportProdDatabase'));
        })->dailyAt('05:00');

        // Sporadic calls

        $schedule->exec('(composer outdated --outdated && npm outdated)')
            ->sendOutputTo(storage_path('app/outDatedDependencies.log'))
            ->emailOutputTo('romain.sauvaire@gmail.com')
            ->weekly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

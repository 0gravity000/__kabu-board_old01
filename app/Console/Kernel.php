<?php

namespace App\Console;

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
        //リアルタイム株価チェック
        $schedule->command('kabu:checkvalue')->everyMinute();
        //日足データチェック
        //タイムアウトにひっかかり全データを一度に取得できない
        //100ずつ38回に分けて取得する
        $schedule->command('kabu:dailydownload01')->weekdays()->dailyAt('17:00')->sendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload02')->weekdays()->dailyAt('17:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload03')->weekdays()->dailyAt('17:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload04')->weekdays()->dailyAt('17:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload05')->weekdays()->dailyAt('17:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload06')->weekdays()->dailyAt('17:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload07')->weekdays()->dailyAt('17:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload08')->weekdays()->dailyAt('17:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload09')->weekdays()->dailyAt('17:16')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload10')->weekdays()->dailyAt('17:18')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload11')->weekdays()->dailyAt('17:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload12')->weekdays()->dailyAt('17:22')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload13')->weekdays()->dailyAt('17:24')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload14')->weekdays()->dailyAt('17:26')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload15')->weekdays()->dailyAt('17:28')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload16')->weekdays()->dailyAt('17:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload17')->weekdays()->dailyAt('17:32')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload18')->weekdays()->dailyAt('17:34')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload19')->weekdays()->dailyAt('17:36')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload20')->weekdays()->dailyAt('17:38')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload21')->weekdays()->dailyAt('17:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload22')->weekdays()->dailyAt('17:42')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload23')->weekdays()->dailyAt('17:44')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload24')->weekdays()->dailyAt('17:46')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload25')->weekdays()->dailyAt('17:48')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload26')->weekdays()->dailyAt('17:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload27')->weekdays()->dailyAt('17:52')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload28')->weekdays()->dailyAt('17:54')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload29')->weekdays()->dailyAt('17:56')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload30')->weekdays()->dailyAt('17:58')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload31')->weekdays()->dailyAt('18:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload32')->weekdays()->dailyAt('18:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload33')->weekdays()->dailyAt('18:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload34')->weekdays()->dailyAt('18:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload35')->weekdays()->dailyAt('18:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload36')->weekdays()->dailyAt('18:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload37')->weekdays()->dailyAt('18:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload38')->weekdays()->dailyAt('18:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
        //$schedule->command('checkKabuValue')->everyMinute();

        //$schedule->exec("touch foo.txt")->everyFiveMinutes();
        // $schedule->command('inspire')
        //          ->hourly();
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

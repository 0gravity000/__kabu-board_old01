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
        $schedule->command('kabu:dailydownload01')->dailyAt('02:00')->sendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload02')->dailyAt('02:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload03')->dailyAt('02:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload04')->dailyAt('02:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload05')->dailyAt('02:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload06')->dailyAt('02:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload07')->dailyAt('02:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload08')->dailyAt('02:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload09')->dailyAt('02:16')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload10')->dailyAt('02:18')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload11')->dailyAt('02:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload12')->dailyAt('02:22')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload13')->dailyAt('02:24')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload14')->dailyAt('02:26')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload15')->dailyAt('02:28')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload16')->dailyAt('02:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload17')->dailyAt('02:32')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload18')->dailyAt('02:34')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload19')->dailyAt('02:36')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload20')->dailyAt('02:38')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload21')->dailyAt('02:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload22')->dailyAt('02:42')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload23')->dailyAt('02:44')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload24')->dailyAt('02:46')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload25')->dailyAt('02:48')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload26')->dailyAt('02:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload27')->dailyAt('02:52')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload28')->dailyAt('02:54')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload29')->dailyAt('02:56')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload30')->dailyAt('02:58')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload31')->dailyAt('03:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload32')->dailyAt('03:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload33')->dailyAt('03:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload34')->dailyAt('03:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload35')->dailyAt('03:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload36')->dailyAt('03:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload37')->dailyAt('03:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload38')->dailyAt('03:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
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

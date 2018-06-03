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
        $schedule->command('kabu:dailydownload_01')->dailyAt('11:39')->sendOutputTo(storage_path('logs/daily_output.txt'));
        /*
        $schedule->command('kabu:dailydownload_02')->dailyAt('00:05')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_03')->dailyAt('00:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_04')->dailyAt('00:15')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_05')->dailyAt('00:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_06')->dailyAt('00:25')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_07')->dailyAt('00:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_08')->dailyAt('00:35')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_09')->dailyAt('00:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_10')->dailyAt('00:45')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_11')->dailyAt('00:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_12')->dailyAt('00:55')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_13')->dailyAt('01:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_14')->dailyAt('01:05')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_15')->dailyAt('01:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_16')->dailyAt('01:15')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_17')->dailyAt('01:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_18')->dailyAt('01:25')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_19')->dailyAt('01:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_20')->dailyAt('01:35')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_21')->dailyAt('01:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_22')->dailyAt('01:45')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_23')->dailyAt('01:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_24')->dailyAt('01:55')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_25')->dailyAt('02:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_26')->dailyAt('02:05')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_27')->dailyAt('02:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_28')->dailyAt('02:15')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_29')->dailyAt('02:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_30')->dailyAt('02:25')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_31')->dailyAt('02:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_32')->dailyAt('02:35')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_33')->dailyAt('02:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_34')->dailyAt('02:45')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_35')->dailyAt('02:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_36')->dailyAt('02:55')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_37')->dailyAt('03:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload_38')->dailyAt('03:05')->appendOutputTo(storage_path('logs/daily_output.txt'));
        */
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

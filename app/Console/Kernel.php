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
        $schedule->command('kabu:checkvalue')->weekdays()->everyMinute()->between('8:58', '15:30');
        //騰落率リセット
        $schedule->command('kabu:resechangetrate')->weekdays()->dailyAt('8:57')->sendOutputTo(storage_path('logs/reset_output.txt'));
        //日足データチェック
        //タイムアウトにひっかかり全データを一度に取得できない
        //100ずつ38回に分けて取得する
        $schedule->command('kabu:dailydownload01')->dailyAt('16:00')->sendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload02')->dailyAt('16:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload03')->dailyAt('16:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload04')->dailyAt('16:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload05')->dailyAt('16:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload06')->dailyAt('16:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload07')->dailyAt('16:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload08')->dailyAt('16:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload09')->dailyAt('16:16')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload10')->dailyAt('16:18')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload11')->dailyAt('16:20')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload12')->dailyAt('16:22')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload13')->dailyAt('16:24')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload14')->dailyAt('16:26')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload15')->dailyAt('16:28')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload16')->dailyAt('16:30')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload17')->dailyAt('16:32')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload18')->dailyAt('16:34')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload19')->dailyAt('16:36')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload20')->dailyAt('16:38')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload21')->dailyAt('16:40')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload22')->dailyAt('16:42')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload23')->dailyAt('16:44')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload24')->dailyAt('16:46')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload25')->dailyAt('16:48')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload26')->dailyAt('16:50')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload27')->dailyAt('16:52')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload28')->dailyAt('16:54')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload29')->dailyAt('16:56')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload30')->dailyAt('16:58')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload31')->dailyAt('17:00')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload32')->dailyAt('17:02')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload33')->dailyAt('17:04')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload34')->dailyAt('17:06')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload35')->dailyAt('17:08')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload36')->dailyAt('17:10')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload37')->dailyAt('17:12')->appendOutputTo(storage_path('logs/daily_output.txt'));
        $schedule->command('kabu:dailydownload38')->dailyAt('17:14')->appendOutputTo(storage_path('logs/daily_output.txt'));
        //黒三平チェック 日足データの後に実行すること
        //30秒タイムアウトにひっかかり全データを一度に実行できない
        //4回に分けて実行する
        $schedule->command('kabu:signalkurosan01')->dailyAt('17:16')->sendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalkurosan02')->dailyAt('17:18')->appendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalkurosan03')->dailyAt('17:20')->appendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalkurosan04')->dailyAt('17:22')->appendOutputTo(storage_path('logs/signal_output.txt'));
        //赤三平チェック 日足データの後に実行すること
        //30秒タイムアウトにひっかかり全データを一度に実行できない
        //4回に分けて実行する
        $schedule->command('kabu:signalakasan01')->dailyAt('17:24')->sendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalakasan02')->dailyAt('17:26')->appendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalakasan03')->dailyAt('17:28')->appendOutputTo(storage_path('logs/signal_output.txt'));
        $schedule->command('kabu:signalakasan04')->dailyAt('17:30')->appendOutputTo(storage_path('logs/signal_output.txt'));

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

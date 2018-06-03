<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CheckDailyValue03;    //イベントクラス名とかぶるとダメ

class DailyKabuDownload03 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kabu:dailydownload03';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download Daily Kabu Value';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        event(new CheckDailyValue03());
    }
}

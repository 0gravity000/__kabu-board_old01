<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CheckDailyValue11;    //イベントクラス名とかぶるとダメ

class DailyKabuDownload11 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kabu:dailydownload11';

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
        event(new CheckDailyValue11());
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CheckSignalKurosan01;    //イベントクラス名とかぶるとダメ

class SignalKurosan01 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kabu:signalkurosan01';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Signal Kurosanpei File phase01';

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
        event(new CheckSignalKurosan01());
    }
}

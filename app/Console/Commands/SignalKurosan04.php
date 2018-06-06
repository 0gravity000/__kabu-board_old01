<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CheckSignalKurosan04;    //イベントクラス名とかぶるとダメ

class SignalKurosan04 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kabu:signalkurosan04';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Signal Kurosanpei File phase04';

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
        event(new CheckSignalKurosan04());
    }
}

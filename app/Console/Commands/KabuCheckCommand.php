<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\CheckKabuValue;    //イベントクラス名とかぶるとダメ

class KabuCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kabu:checkvalue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Kabu Value';

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
        //
        echo "in KabuCheckCommand";
        event(new CheckKabuValue());
    }
}

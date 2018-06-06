<?php

namespace App\Listeners;

use App\Events\CheckSignalKurosan03;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeFileKurosan03
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckSignalKurosan03  $event
     * @return void
     */
    public function handle(CheckSignalKurosan03 $event)
    {
        //
    }
}

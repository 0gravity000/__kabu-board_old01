<?php

namespace App\Listeners;

use App\Events\CheckSignalKurosan04;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeFileKurosan04
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
     * @param  CheckSignalKurosan04  $event
     * @return void
     */
    public function handle(CheckSignalKurosan04 $event)
    {
        //
    }
}

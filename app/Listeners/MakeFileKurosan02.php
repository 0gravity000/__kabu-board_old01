<?php

namespace App\Listeners;

use App\Events\CheckSignalKurosan02;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakeFileKurosan02
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
     * @param  CheckSignalKurosan02  $event
     * @return void
     */
    public function handle(CheckSignalKurosan02 $event)
    {
        //
    }
}

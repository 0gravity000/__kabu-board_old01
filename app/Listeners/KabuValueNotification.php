<?php

namespace App\Listeners;

use App\Events\CheckKabuValue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Established_value;

class KabuValueNotification
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
     * @param  CheckKabuValue  $event
     * @return void
     */
    public function handle(CheckKabuValue $event)
    {
        //debug
        //var_dump("Event Notify!");
        log::debug("in KabuValueNotification.php");
        Mail::to('aihowareyou@gmail.com')->send(new Established_value());
    }
}

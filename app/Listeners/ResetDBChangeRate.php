<?php

namespace App\Listeners;

use App\Events\ResetChangeRateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Realtime;

class ResetDBChangeRate
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
     * @param  ResetChangeRateEvent  $event
     * @return void
     */
    public function handle(ResetChangeRateEvent $event)
    {
      var_dump('reset changerate start');
      $Realtimes = Realtime::all();
      foreach ($Realtimes as $Realtime) {
        $Realtime->changerate = 0;
        $Realtime->pre_changerate = 0;
        $Realtime->changecount = 0;
        $Realtime->save();
      }
      var_dump('reset changerate done!');
    }
}

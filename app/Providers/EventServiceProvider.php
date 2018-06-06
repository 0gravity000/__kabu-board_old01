<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CheckKabuValue' => [
            'App\Listeners\KabuValueNotification',
        ],
        'App\Events\CheckDailyValue01' => [
            'App\Listeners\DownloadDailyValue01',
        ],
        'App\Events\CheckDailyValue02' => [
            'App\Listeners\DownloadDailyValue02',
        ],
        'App\Events\CheckDailyValue03' => [
            'App\Listeners\DownloadDailyValue03',
        ],
        'App\Events\CheckDailyValue04' => [
            'App\Listeners\DownloadDailyValue04',
        ],
        'App\Events\CheckDailyValue05' => [
            'App\Listeners\DownloadDailyValue05',
        ],
        'App\Events\CheckDailyValue06' => [
            'App\Listeners\DownloadDailyValue06',
        ],
        'App\Events\CheckDailyValue07' => [
            'App\Listeners\DownloadDailyValue07',
        ],
        'App\Events\CheckDailyValue08' => [
            'App\Listeners\DownloadDailyValue08',
        ],
        'App\Events\CheckDailyValue09' => [
            'App\Listeners\DownloadDailyValue09',
        ],
        'App\Events\CheckDailyValue10' => [
            'App\Listeners\DownloadDailyValue10',
        ],
        'App\Events\CheckDailyValue11' => [
            'App\Listeners\DownloadDailyValue11',
        ],
        'App\Events\CheckDailyValue12' => [
            'App\Listeners\DownloadDailyValue12',
        ],
        'App\Events\CheckDailyValue13' => [
            'App\Listeners\DownloadDailyValue13',
        ],
        'App\Events\CheckDailyValue14' => [
            'App\Listeners\DownloadDailyValue14',
        ],
        'App\Events\CheckDailyValue15' => [
            'App\Listeners\DownloadDailyValue15',
        ],
        'App\Events\CheckDailyValue16' => [
            'App\Listeners\DownloadDailyValue16',
        ],
        'App\Events\CheckDailyValue17' => [
            'App\Listeners\DownloadDailyValue17',
        ],
        'App\Events\CheckDailyValue18' => [
            'App\Listeners\DownloadDailyValue18',
        ],
        'App\Events\CheckDailyValue19' => [
            'App\Listeners\DownloadDailyValue19',
        ],
        'App\Events\CheckDailyValue20' => [
            'App\Listeners\DownloadDailyValue20',
        ],
        'App\Events\CheckDailyValue21' => [
            'App\Listeners\DownloadDailyValue21',
        ],
        'App\Events\CheckDailyValue22' => [
            'App\Listeners\DownloadDailyValue22',
        ],
        'App\Events\CheckDailyValue23' => [
            'App\Listeners\DownloadDailyValue23',
        ],
        'App\Events\CheckDailyValue24' => [
            'App\Listeners\DownloadDailyValue24',
        ],
        'App\Events\CheckDailyValue25' => [
            'App\Listeners\DownloadDailyValue25',
        ],
        'App\Events\CheckDailyValue26' => [
            'App\Listeners\DownloadDailyValue26',
        ],
        'App\Events\CheckDailyValue27' => [
            'App\Listeners\DownloadDailyValue27',
        ],
        'App\Events\CheckDailyValue28' => [
            'App\Listeners\DownloadDailyValue28',
        ],
        'App\Events\CheckDailyValue29' => [
            'App\Listeners\DownloadDailyValue29',
        ],
        'App\Events\CheckDailyValue30' => [
            'App\Listeners\DownloadDailyValue30',
        ],
        'App\Events\CheckDailyValue31' => [
            'App\Listeners\DownloadDailyValue31',
        ],
        'App\Events\CheckDailyValue32' => [
            'App\Listeners\DownloadDailyValue32',
        ],
        'App\Events\CheckDailyValue33' => [
            'App\Listeners\DownloadDailyValue33',
        ],
        'App\Events\CheckDailyValue34' => [
            'App\Listeners\DownloadDailyValue34',
        ],
        'App\Events\CheckDailyValue35' => [
            'App\Listeners\DownloadDailyValue35',
        ],
        'App\Events\CheckDailyValue36' => [
            'App\Listeners\DownloadDailyValue36',
        ],
        'App\Events\CheckDailyValue37' => [
            'App\Listeners\DownloadDailyValue37',
        ],
        'App\Events\CheckDailyValue38' => [
            'App\Listeners\DownloadDailyValue38',
        ],
        'App\Events\CheckSignalKurosan01' => [
            'App\Listeners\MakeFileKurosan01',
        ],
        'App\Events\CheckSignalKurosan02' => [
            'App\Listeners\MakeFileKurosan02',
        ],
        'App\Events\CheckSignalKurosan03' => [
            'App\Listeners\MakeFileKurosan03',
        ],
        'App\Events\CheckSignalKurosan04' => [
            'App\Listeners\MakeFileKurosan04',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

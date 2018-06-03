<?php

namespace App\Listeners;

use App\Events\CheckDailyValue16;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DownloadDailyValue16
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
     * @param  CheckDailyValue16  $event
     * @return void
     */
    public function handle(CheckDailyValue16 $event)
    {
        $meigaras = DB::table('meigaras')->orderBy('code')
                                            ->where('code', '>=', 4827)
                                            ->where('code', '<', 5202)->get();
        //$Meigaras = Meigara::all();   //タイムアウト30秒にひっかかり全部を一度に取得できない
        foreach ($meigaras as $meigara) {   //全銘柄ループ
          $client = new Client();   //composer require fabpot/goutte しておくこと
            $meigara->code;
            var_dump($meigara->code);
                //URL設定
            $marketcode = '.T';
            if ($meigara->marketcode == 8 or $meigara->marketcode == 9) {
              $marketcode = '.S';
            }
            if ($meigara->marketcode == 10 or $meigara->marketcode == 11) {
              $marketcode = '.F';
            }
            if ($meigara->marketcode == 12 or $meigara->marketcode == 13 or $meigara->marketcode == 14) {
              $marketcode = '.N';
            }
            $html = 'http://stocks.finance.yahoo.co.jp/stocks/detail/?code='.$meigara->code.$marketcode;
                            //https://stocks.finance.yahoo.co.jp/stocks/detail/?code=1301
            $crawler = $client->request('GET', $html);

            //日足用データ取得
          //前日終値
          //#detail > div.innerDate > div:nth-child(1) > dl > dd > strong
          $preEndvalue = $crawler->filter('#detail > div.innerDate > div:nth-child(1) > dl > dd > strong')->text();
            //dd($preEndvalue);
          //始値
                //#detail > div.innerDate > div:nth-child(2) > dl > dd > strong      
          $startValue = $crawler->filter('#detail > div.innerDate > div:nth-child(2) > dl > dd > strong')->text();
            //dd($startValue);
          //高値
          //#detail > div.innerDate > div:nth-child(3) > dl > dd > strong
          $highValue = $crawler->filter('#detail > div.innerDate > div:nth-child(3) > dl > dd > strong')->text();
            //dd($highValue);
          //安値
          $lowValue = $crawler->filter('#detail > div.innerDate > div:nth-child(4) > dl > dd > strong')->text();
            //dd($lowValue);
          //出来高
          //#detail > div.innerDate > div:nth-child(5) > dl > dd > strong
          $volume = $crawler->filter('#detail > div.innerDate > div:nth-child(5) > dl > dd > strong')->text();
            //dd($volume);
            $fileOutputString = $meigara->code .'/'. $preEndvalue .'/'. $startValue .'/'. $highValue .'/'. $lowValue .'/'. $volume .'\n';

            //ファイル出力
            $today = Carbon::now()->toDateString();

            Storage::append(('kabus/daily/'. $today .'.txt'), $fileOutputString );

        }   //全銘柄ループエンド

    }
}

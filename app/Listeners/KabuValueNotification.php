<?php

namespace App\Listeners;

use App\Events\CheckKabuValue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Realtime;
use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\Auth;
use App\User;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Established_value;
use App\Mail\Establish_changerate;

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
        //Mail::to('aihowareyou@gmail.com')->send(new Established_value());
        //log::debug("in KabuValueNotification.php");

          //動作処理
          $a_temp;
          $b_temp;
          $c_temp;
          $d_temp;
          $client = new Client();
          //$Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
          $Realtimes = Realtime::all();
          foreach ($Realtimes as $Realtime) {
            // Get Data Source
            //$html = 'http://stocks.finance.yahoo.co.jp/stocks/detail/?code=3758.T';
            $marketcode = '.T';
            if ($Realtime->marketcode == 8 or $Realtime->marketcode == 9) {
              $marketcode = '.S';
            }
            if ($Realtime->marketcode == 10 or $Realtime->marketcode == 11) {
              $marketcode = '.F';
            }
            if ($Realtime->marketcode == 12 or $Realtime->marketcode == 13 or $Realtime->marketcode == 14) {
              $marketcode = '.N';
            }
            $html = 'http://stocks.finance.yahoo.co.jp/stocks/detail/?code='.$Realtime->code.$marketcode;
            $crawler = $client->request('GET', $html);
            //dd($crawler);
            //現在値
            $a_temp = $crawler->filter('table.stocksTable tr')->each(function ($node) {
              $g_temp;
              //銘柄名
              //dd($node->filter('th')->eq(0)->text());
              //現在値
              //dd($node->filter('td')->eq(1)->text());
              //前日比
              //dd($node->filter('span')->eq(1)->text());
              $g_temp = $node->filter('td')->eq(1)->text();
              return $g_temp;
            });
            //騰落率　加工前データ +-xx（x.xx%）
            $d_temp = $crawler->filter('table.stocksTable tr')->each(function ($node) {
              $g_temp;
              $g_temp = $node->filter('td.change span')->eq(1)->text(); //-xx（x｡xx%）
              //dd($g_temp);
              return $g_temp;
            });
            //dd($d_temp);

            //高値(2)、安値(3)
            $b_temp = $crawler->filter('dd.ymuiEditLink')->each(function ($node) {
              $g_temp;
              $g_temp = $node->filter('strong')->eq(0)->text();
              return $g_temp;
            });

            //高値時刻(2)、安値時刻(3)
            $c_temp = $crawler->filter('dd.ymuiEditLink span.date')->each(function ($node) {
              $g_temp;
              $g_temp = $node->eq(0)->text();
              return $g_temp;
            });

            //現在値
            $number = str_replace(',','',$a_temp[0]);
            //var_dump(intval($number));
            $Realtime->value = intval($number);

            //高値(2)、安値(3)
            $number = str_replace(',','',$b_temp[2]);
            $Realtime->uppervalue = intval($number);
            $number = str_replace(',','',$b_temp[3]);
            $Realtime->lowervalue = intval($number);

            //高値時刻(2)、安値時刻(3)
            $number = str_replace('（','',$c_temp[2]);
            $number = str_replace('）','',$number);
            $number = str_replace('/',':',$number);
            if(ctype_digit($number)) {
              $time = new DateTime($number.':00');
              //dd($time);
              $Realtime->uv_updateat = $time;
            }
            $number = str_replace('（','',$c_temp[3]);
            $number = str_replace('）','',$number);
            $number = str_replace('/',':',$number);
            if(ctype_digit($number)) {
              $time = new DateTime($number.':00');
              $Realtime->lv_updateat = $time;
            }

            //騰落率　加工前データ +-xx（x.xx%）
            $startpos = mb_strpos($d_temp[0], '（');
            //var_dump($startpos);
            $endpos = mb_strpos($d_temp[0], '%');
            //var_dump($endpos);
            $number = mb_substr($d_temp[0], $startpos+1, ($endpos-$startpos)-1);
            //dd($number);
            $Realtime->changerate = doubleval($number);

            $Realtime->save();

            //値のチェック
            $hitflag = false;
            if($Realtime->sendflag == false){
              if($Realtime->value != null){
                if($Realtime->value != 0){

                  if($Realtime->upperlimit != null) {
                    if($Realtime->upperlimit != 0) {
                      if($Realtime->value >= $Realtime->upperlimit) {
                        $hitflag = true;
                      }
                    }
                  }

                  if($Realtime->lowerlimit != null) {
                    if($Realtime->lowerlimit != 0) {
                      if($Realtime->value <= $Realtime->lowerlimit) {
                        $hitflag = true;
                      }
                    }
                  }

                }
              }
            }

            //Log::debug($Realtime->name);    //debug
            if($hitflag == true){
              //Log::debug($hitflag);         //debug
              if($Realtime->sendflag == false){
                //Log::debug($Realtime->sendflag);        //debug
                $Realtime->sendflag = true;
                $Realtime->save();
                //dd($Realtime->sendflag);
              //メール送信
                $users = User::where('id', $Realtime->user_id)->get();
                //dd($users);
                Mail::to($users)->send(new Established_value($Realtime));
              }
            }

            //騰落率のチェック
            $hitflag_changerate = false;
            //if($Realtime->sendflag_changerate == false){  //何度もチェックしたい
              if($Realtime->changerate != null){
                if($Realtime->pre_changerate != null){
                  if($Realtime->changerate_range != null){
                    $diff = ($Realtime->pre_changerate - $Realtime->changerate);
                    //dd($diff);
                    if(abs($diff) >= $Realtime->changerate_range){
                      $hitflag_changerate = true;
                    }
                  }
                }
              }
            //}

            if($hitflag_changerate == true){
              $Realtime->sendflag_changerate = true;
              $Realtime->changecount = $Realtime->changecount +1;
              $Realtime->save();
              //dd($Realtime->sendflag);
            //メール送信
              $users = User::where('id', $Realtime->user_id)->get();
              //dd($users);
              Mail::to($users)->send(new Establish_changerate($Realtime));
            }

            //前回値へ退避
            if($Realtime->value != NULL){
              if($Realtime->value != 0){
                $Realtime->pre_value = $Realtime->value;
                $Realtime->save();
              }
            }

            //前回騰落率へ退避
            if($Realtime->changerate != NULL){
              if($Realtime->changerate != 0){
                $Realtime->pre_changerate = $Realtime->changerate;
                $Realtime->save();
              }
            }

          } //foreach

    }
}

<?php

namespace App\Listeners;

use App\Events\CheckSignalKurosan01;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use App\Meigara;
use Illuminate\Support\Facades\Storage;

class MakeFileKurosan01
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
     * @param  CheckSignalKurosan01  $event
     * @return void
     */
    public function handle(CheckSignalKurosan01 $event)
    {
        $dt = Carbon::now();
        //基準日(当日)の算出
        //時間チェック
        if($dt->hour < 18) {    
            //18時より前は当日分のファイルがないので前日を基準に設定する
            $dt->subDay();
        }
        //週末チェック
        if($dt->dayOfWeek == 6){    //土曜
            $dt->subDay();
        } elseif ($dt->dayOfWeek == 0) {    //日曜
            $dt->subDay(2);
        }
            $basedayfile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

        //1日前を算出
            $dt->subDay();
        //週末チェック
        if($dt->dayOfWeek == 6){    //土曜
            $dt->subDay();
        } elseif ($dt->dayOfWeek == 0) {    //日曜
            $dt->subDay(2);
        }
            $onedayagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

        //2日前を算出
            $dt->subDay();
        //週末チェック
        if($dt->dayOfWeek == 6){    //土曜
            $dt->subDay();
        } elseif ($dt->dayOfWeek == 0) {    //日曜
            $dt->subDay(2);
        }
            $twodaysagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

        //3日前を算出
            $dt->subDay();
        //週末チェック
        if($dt->dayOfWeek == 6){    //土曜
            $dt->subDay();
        } elseif ($dt->dayOfWeek == 0) {    //日曜
            $dt->subDay(2);
        }
        $threedaysagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

        $filepath = storage_path('app/kabus/daily');
        //$filepath = '../storage/app/kabus/daily';

        $contents = '';
        //$Dailys = [];
        //$Files = [ $basedayfile, $onedayagofile, $twodaysagofile, $threedaysagofile ];
        //dd($Files);
        //if (\File::exists($filepath .'/'.$threedaysagofile)) {
        var_dump($filepath .'/'.$threedaysagofile);
            //ファイルあり
            $contents = \File::get($filepath .'/'.$threedaysagofile);
            //データ抽出
            $startpos = 0;
            while(mb_strpos($contents, '\n', $startpos)){
                $endpos = mb_strpos($contents, '\n', $startpos);
                $rowstring = mb_substr($contents, $startpos, $endpos - $startpos);

                $dailysArray = mb_split('/', $rowstring);
                //dd($dailysArray);
                //改行コードの調整
                $code = str_replace(array("\n", "n"), '', $dailysArray[0]);
                if ($dailysArray[1] != "---") { //終値が---でないもの
                    if (intval($dailysArray[1]) < intval($dailysArray[3])) {  //終値 < 始値 ?
                        $meigaras = Meigara::where('code', $code)->first();
                        $name = $meigaras->name;
                        //dd($Dailys);
                        $fileOutputString = $code .'/'. $dailysArray[1] .'\n';
                        //ファイル出力
                        $today = Carbon::now()->toDateString();
                        Storage::append(('kabus/signal/'. $today .'_kurosan01.txt'), $fileOutputString );
                    }
                }
                //var_dump($fileloop);
                $startpos = $endpos+1;
            }
        /*
        } else {
            //ファイルがない
            $fileOutputString = "---" .'/'. "---" .'\n';
            //ファイル出力
            $today = Carbon::now()->toDateString();
            Storage::append(('kabus/signal/'. $today .'_kurosan01.txt'), $fileOutputString );
        }
        */
        //dd($Dailys);
    }
}

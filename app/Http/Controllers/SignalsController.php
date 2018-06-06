<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Meigara;

class SignalsController extends Controller
{
  public function index_sanpei()
  {
  	$dt = Carbon::now();
  	$nowYear = $dt->year;
  	$nowMonth = $dt->month;
  	$nowDay = $dt->day;
  	//dd($nowYear, $nowMonth, $nowDay);
    return view('signals.index_sanpei', compact('nowYear', 'nowMonth', 'nowDay'));
	}

  public function show_sanpei()
  {
		//$dt = Carbon::create(request()->year, request()->month, request()->day);
  	$dt = Carbon::now();
  	//基準日(当日)の算出
  	//時間チェック
  	if($dt->hour < 18) {	
  		//18時より前は当日分のファイルがないので前日を基準に設定する
  		$dt->subDay();
  	}
  	//週末チェック
  	if($dt->dayOfWeek == 6){	//土曜
  		$dt->subDay();
  	} elseif ($dt->dayOfWeek == 0) {	//日曜
  		$dt->subDay(2);
  	}
		$basedayfile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

  	//1日前を算出
		$dt->subDay();
  	//週末チェック
  	if($dt->dayOfWeek == 6){	//土曜
  		$dt->subDay();
  	} elseif ($dt->dayOfWeek == 0) {	//日曜
  		$dt->subDay(2);
  	}
		$onedayagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

  	//2日前を算出
		$dt->subDay();
  	//週末チェック
  	if($dt->dayOfWeek == 6){	//土曜
  		$dt->subDay();
  	} elseif ($dt->dayOfWeek == 0) {	//日曜
  		$dt->subDay(2);
  	}
		$twodaysagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

  	//3日前を算出
		$dt->subDay();
  	//週末チェック
  	if($dt->dayOfWeek == 6){	//土曜
  		$dt->subDay();
  	} elseif ($dt->dayOfWeek == 0) {	//日曜
  		$dt->subDay(2);
  	}
		$threedaysagofile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day).".txt";

		$filepath = '../storage/app/kabus/daily';

  	$contents = '';
  	$Dailys = array(array(), array(), array(), array());
  	$Files = [ $basedayfile, $onedayagofile, $twodaysagofile, $threedaysagofile ];
		//dd($Files);
		for ($fileloop=0; $fileloop < 4; $fileloop++) {	 //4日分ループ //30秒の制約にひっかかる。
			if (\File::exists($filepath .'/'.$Files[$fileloop])) {
				//ファイルあり
				$contents = \File::get($filepath .'/'.$Files[$fileloop]);
				//dd($contents);
				//データ抽出
				$startpos = 0;
				while(mb_strpos($contents, '\n', $startpos)){
		      $endpos = mb_strpos($contents, '\n', $startpos);
		      $rowstring = mb_substr($contents, $startpos, $endpos - $startpos);

					$dailysArray = mb_split('/', $rowstring);
					//dd($dailysArray);
					//改行コードの調整
					$code = str_replace(array("\n", "n"), '', $dailysArray[0]);
					$meigaras = Meigara::where('code', $code)->first();
					$name = $meigaras->name;
					$Dailys_temp = [
		    		"code" => $code,
		    		"name" => $name,
		    		"endValue" => $dailysArray[1],
					];
					//dd($Dailys);
					array_push($Dailys[$fileloop], $Dailys_temp);
					//var_dump($fileloop);
					$startpos = $endpos+1;
				}
			} else {
				//ファイルがない
				$Dailys_temp = [
	    		"code" => "",
	    		"name" => "",
	    		"endValue" => "",
				];
				array_push($Dailys[$fileloop], $Dailys_temp);
			}
		}	//4日分ループend
		dd($Dailys);

    return view('signals.show_sanpei');
	}

}

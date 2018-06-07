<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Meigara;

class SignalsController extends Controller
{
  public function index_kurosanpei()
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

    $targetfile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day)."_kurosan.txt";
    $filepath_signal = storage_path('app/kabus/signal');
  	$Sanpeis = [];
    if (\File::exists($filepath_signal .'/'. $targetfile)) {
			$contents = \File::get($filepath_signal .'/'. $targetfile);
      $startpos = 0;
      while(mb_strpos($contents, '\n', $startpos)){
        $endpos = mb_strpos($contents, '\n', $startpos);
        $rowstring = mb_substr($contents, $startpos, $endpos - $startpos);
        $dailysArray = mb_split('/', $rowstring);
        $code = str_replace(array("\n", "n","C"), '', $dailysArray[0]);
				$meigaras = Meigara::where('code', $code)->first();
				$name = $meigaras->name;
				$downvalue = intval($dailysArray[4]) - intval($dailysArray[1]);
				$downrate = sprintf('%.2f', intval($downvalue) / intval($dailysArray[1]) *100);
				$Sanpeis_temp = [
	    		"code" => $code,
	    		"name" => $name,
	    		"endValue03" => $dailysArray[1],
	    		"endValue02" => $dailysArray[2],	
	    		"endValue01" => $dailysArray[3],	
	    		"endValue" => $dailysArray[4],
	    		"downvalue" => $downvalue,
	    		"downrate" => $downrate,
				];
				array_push($Sanpeis, $Sanpeis_temp);
	      $startpos = $endpos+1;
	   }
		}
		//dd($Sanpeis);
		$today = $dt->toDateString();
    return view('signals.index_kurosanpei', compact('Sanpeis', 'today'));
	}

  public function index_akasanpei()
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

    $targetfile = $dt->year.'-'.sprintf('%02d', $dt->month).'-'.sprintf('%02d', $dt->day)."_akasan.txt";
    $filepath_signal = storage_path('app/kabus/signal');
  	$Sanpeis = [];
    if (\File::exists($filepath_signal .'/'. $targetfile)) {
			$contents = \File::get($filepath_signal .'/'. $targetfile);
      $startpos = 0;
      while(mb_strpos($contents, '\n', $startpos)){
        $endpos = mb_strpos($contents, '\n', $startpos);
        $rowstring = mb_substr($contents, $startpos, $endpos - $startpos);
        $dailysArray = mb_split('/', $rowstring);
        $code = str_replace(array("\n", "n","C"), '', $dailysArray[0]);
				$meigaras = Meigara::where('code', $code)->first();
				$name = $meigaras->name;
				$upvalue = intval($dailysArray[4]) - intval($dailysArray[1]);
				$uprate = sprintf('%.2f', intval($upvalue) / intval($dailysArray[1]) *100);
				$Sanpeis_temp = [
	    		"code" => $code,
	    		"name" => $name,
	    		"endValue03" => $dailysArray[1],
	    		"endValue02" => $dailysArray[2],	
	    		"endValue01" => $dailysArray[3],	
	    		"endValue" => $dailysArray[4],
	    		"upvalue" => $upvalue,
	    		"uprate" => $uprate,
				];
				array_push($Sanpeis, $Sanpeis_temp);
	      $startpos = $endpos+1;
	   }
		}
		//dd($Sanpeis);
		$today = $dt->toDateString();
    return view('signals.index_akasanpei', compact('Sanpeis', 'today'));
	}

  public function index_volumeup()
  {
	 	$dt = Carbon::now();
	 	$nowYear = $dt->year;
	 	$nowMonth = $dt->month;
	 	$nowDay = $dt->day;
	 	//dd($nowYear, $nowMonth, $nowDay);
	   return view('signals.index_volumeup', compact('nowYear', 'nowMonth', 'nowDay'));
	}

  public function show_volumeup()
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

    $filepath = storage_path('app/kabus/daily');

  	$contents = '';
  	$contents_pre = '';
  	$Volums = [];
  	//$Dailys = array(array(), array());
  	//$Files = [ $basedayfile, $onedayagofile ];
		//dd($Files);
		if (\File::exists($filepath .'/'.$basedayfile)) {
			//ファイルあり
			$contents = \File::get($filepath .'/'.$basedayfile);
			$contents_pre = \File::get($filepath .'/'.$onedayagofile);
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
        if ($dailysArray[6] != "---") { //終値が---でないもの
            //前日ファイルの、該当コードを探す
            $pre_startpos = mb_strpos($contents_pre, $code.'/');
            if ($pre_startpos) {
              //前日出来高を取得
              $pre_endpos = mb_strpos($contents_pre, '\n', $pre_startpos);
              $pre_rowstring = mb_substr($contents_pre, $pre_startpos, $pre_endpos - $pre_startpos);
							$pre_dailysArray = mb_split('/', $pre_rowstring);
							//当日出来高と前日出来高を比較
							//当日出来高が10,000以上かつ5倍以上のものを抽出
							$volume = str_replace(',', '', $dailysArray[6]);
							$pre_volume = str_replace(',', '', $pre_dailysArray[6]);
							if(intval($volume) > 10000){
								if (intval($volume) > intval($pre_volume)*5) {
									$meigaras = Meigara::where('code', $code)->first();
									$name = $meigaras->name;
									$volumerate = sprintf('%.2f', (intval($volume) / intval($pre_volume)));
									$Volums_temp = [
						    		"code" => $code,
						    		"name" => $name,
						    		"volume" => $dailysArray[6],
						    		"pre_volume" => $pre_dailysArray[6],
						    		"volumerate" => $volumerate,
									];
									array_push($Volums, $Volums_temp);
								}
							}
            }
        }
				$startpos = $endpos+1;
			}
		} else {
			//ファイルがない
			$Dailys_temp = [
    		"code" => "",
    		"name" => "",
    		"volume" => "",
    		"pre_volume" => "",
    		"volumerate" => "",
			];
			array_push($Volums, $Volums_temp);
		}
		//dd($Volums);

	 	$dt = Carbon::now();
	 	$nowYear = $dt->year;
	 	$nowMonth = $dt->month;
	 	$nowDay = $dt->day;

    return view('signals.show_volumeup', compact('Volums', 'nowYear', 'nowMonth', 'nowDay'));
	}

}

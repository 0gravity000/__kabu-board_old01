<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class AnalysesController extends Controller
{
	//private $StockCollection = [];

  public function index()
  {
  	$dt = Carbon::now();
  	$nowYear = $dt->year;
  	$nowMonth = $dt->month;
  	$nowDay = $dt->day;
  	//dd($nowYear, $nowMonth, $nowDay);
    return view('analyses.index', compact('nowYear', 'nowMonth', 'nowDay'));
	}

  public function show()
  {
		$targetfile = request()->year.'-'.sprintf('%02d', request()->month).'-'.sprintf('%02d', request()->day).".txt";
		//dd($targetfile);

		//ファイルの存在チェック	
		$filepath = '../storage/app/kabus/daily';
  	$Files = \File::files($filepath);
  	$contents = '';
  	$Dailys = [];
		if (\File::exists($filepath .'/'.$targetfile)) {
			//ファイルあり
			$contents = \File::get($filepath .'/'.$targetfile);
			//dd($contents);
			//データ抽出
			$startpos = 0;
			while(mb_strpos($contents, '\n', $startpos)){
	      $endpos = mb_strpos($contents, '\n', $startpos);
	      $rowstring = mb_substr($contents, $startpos, $endpos - $startpos);

				$dailysArray = mb_split('/', $rowstring);
				//dd($dailysArray);
				$code = str_replace(array("\n", "n"), '', $dailysArray[0]);
				$meigaras = Meigara::where('code', $code)->first();
				$name = $meigaras->name;
				$Dailys_temp = [
	    		"code" => $code,
	    		"name" => $name,
	    		"preEndvalue" => $dailysArray[1],	
	    		"startValue" => $dailysArray[2],	
	    		"highValue" => $dailysArray[3],	
	    		"lowValue" => $dailysArray[4],	
	    		"volume" => $dailysArray[5],
				];
				array_push($Dailys, $Dailys_temp);
				//開業コードの調整
				$startpos = $endpos+1;
			}
		} else {
			//ファイルがない
			$Dailys_temp = [
    		"code" => "",
    		"name" => "",
    		"preEndvalue" => "",	
    		"startValue" => "",	
    		"highValue" => "",	
    		"lowValue" => "",	
    		"volume" => "",
			];
			array_push($Dailys, $Dailys_temp);
		}

		//dd($Dailys);

  	$dt = Carbon::now();
  	$nowYear = $dt->year;
  	$nowMonth = $dt->month;
  	$nowDay = $dt->day;
    return view('analyses.show', compact('Dailys', 'nowYear', 'nowMonth', 'nowDay'));
	}

}

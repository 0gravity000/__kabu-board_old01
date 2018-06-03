<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

class AnalysesController extends Controller
{
	private $StockCollection = [];

  public function index()
  {
    return view('analyses.index');
    //return view('meigaras.index', compact('Meigaras'));
	}

  public function create()
  {
    $StockCollection = [];
  	for ($chunkloop=0; $chunkloop < 10 ; $chunkloop++) { //chunk loop
  		if ($chunkloop == 0) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																		->where('code', '<', 1828)->get();
  		} elseif ($chunkloop == 1) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 1828)
		  																			->where('code', '<', 2004)->get();
  		} elseif ($chunkloop == 2) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 2004)
		  																			->where('code', '<', 2311)->get();
  		} elseif ($chunkloop == 3) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 2311)
		  																			->where('code', '<', 2501)->get();
  		} elseif ($chunkloop == 4) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 2501)
		  																			->where('code', '<', 2795)->get();
  		} elseif ($chunkloop == 5) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 2795)
		  																			->where('code', '<', 3073)->get();
  		} elseif ($chunkloop == 6) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 2795)
		  																			->where('code', '<', 3230)->get();
  		} elseif ($chunkloop == 7) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 3230)
		  																			->where('code', '<', 3422)->get();
  		} elseif ($chunkloop == 8) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 3422)
		  																			->where('code', '<', 3632)->get();
  		} elseif ($chunkloop == 9) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 3632)
		  																			->where('code', '<', 3788)->get();
  		} elseif ($chunkloop == 10) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 3788)
		  																			->where('code', '<', 3944)->get();
  		} elseif ($chunkloop == 11) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 3944)
		  																			->where('code', '<', 4186)->get();
  		} elseif ($chunkloop == 12) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 4186)
		  																			->where('code', '<', 4409)->get();
  		} elseif ($chunkloop == 13) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 4409)
		  																			->where('code', '<', 4642)->get();
  		} elseif ($chunkloop == 14) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 4642)
		  																			->where('code', '<', 4827)->get();
  		} elseif ($chunkloop == 15) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 4827)
		  																			->where('code', '<', 5202)->get();
  		} elseif ($chunkloop == 16) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 5202)
		  																			->where('code', '<', 5660)->get();
  		} elseif ($chunkloop == 17) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 5660)
		  																			->where('code', '<', 5988)->get();
  		} elseif ($chunkloop == 18) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 5988)
		  																			->where('code', '<', 6144)->get();
  		} elseif ($chunkloop == 19) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6144)
		  																			->where('code', '<', 6301)->get();
  		} elseif ($chunkloop == 20) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6301)
		  																			->where('code', '<', 6454)->get();
  		} elseif ($chunkloop == 21) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6454)
		  																			->where('code', '<', 6615)->get();
  		} elseif ($chunkloop == 22) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6615)
		  																			->where('code', '<', 6776)->get();
  		} elseif ($chunkloop == 23) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6776)
		  																			->where('code', '<', 6938)->get();
  		} elseif ($chunkloop == 24) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 6938)
		  																			->where('code', '<', 7230)->get();
  		} elseif ($chunkloop == 25) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 7230)
		  																			->where('code', '<', 7475)->get();
  		} elseif ($chunkloop == 26) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 7475)
		  																			->where('code', '<', 7638)->get();
  		} elseif ($chunkloop == 27) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 7638)
		  																			->where('code', '<', 7862)->get();
  		} elseif ($chunkloop == 28) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 7862)
		  																			->where('code', '<', 7999)->get();
  		} elseif ($chunkloop == 29) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 7999)
		  																			->where('code', '<', 8144)->get();
  		} elseif ($chunkloop == 30) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 8144)
		  																			->where('code', '<', 8350)->get();
  		} elseif ($chunkloop == 31) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 8350)
		  																			->where('code', '<', 8706)->get();
  		} elseif ($chunkloop == 32) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 8706)
		  																			->where('code', '<', 9014)->get();
  		} elseif ($chunkloop == 33) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 9014)
		  																			->where('code', '<', 9318)->get();
  		} elseif ($chunkloop == 34) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 9318)
		  																			->where('code', '<', 9603)->get();
  		} elseif ($chunkloop == 35) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 9603)
		  																			->where('code', '<', 9790)->get();
  		} elseif ($chunkloop == 36) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 9790)
		  																			->where('code', '<', 9990)->get();
  		} elseif ($chunkloop == 37) {
		  	$meigaras = DB::table('meigaras')->orderBy('code')
		  																			->where('code', '>=', 9990)
		  																			->where('code', '<', 9997)->get();
  		}
      //dd($meigaras);
  		//$Meigaras = Meigara::all();	//タイムアウト30秒にひっかかり全部を一度に取得できない
	    //$StockCollection_chunk = [];
	    foreach ($meigaras as $meigara) {	//全銘柄ループ
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

	    	$StockCollection_temp = [
	    		"code" => $meigara->code,
	    		"preEndvalue" => $preEndvalue,
	    		"startValue" => $startValue,
	    		"highValue" => $highValue,
	    		"lowValue" => $lowValue,
	    		"volume" => $volume,
	    	];
	    	array_push($StockCollection, $StockCollection_temp);
			}	//全銘柄ループエンド
  	}	//chnkloop end
		dd($StockCollection);

    return view('analyses.index');
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meigara;

use Goutte\Client;
use Illuminate\Support\Facades\DB;

class MeigarasController extends Controller
{
  public function index()
  {
    $Meigaras = Meigara::all();
    //dd($Meigaras->first()->code);
    return view('meigaras.index', compact('Meigaras'));
  }

  public function reload()
  {

    $MeigaraCollection = [];
  	$baseurl = 'https://stocks.finance.yahoo.co.jp/stocks/qi/?ids=';
  	$gyousyu = [
    		'0050',
    		'1050',
    		'2050',
    		'3050',
				'3100',
				'3150',
				'3200',
				'3250',
				'3300',
				'3350',
				'3400',
				'3450',
				'3500',
				'3550',
				'3600',
				'3650',
				'3700',
				'3750',
				'3800',
				'4050',
				'5050',
				'5100',
				'5150',
				'5200',
				'5250',
				'6050',
				'6100',
				'7050',
				'7100',
				'7150',
				'7200',
				'8050',
				'9050'
			];

    for ($urlloop=0; $urlloop < count($gyousyu); $urlloop++) {	//urlループ

	    $page = '1';
	    for ($pageloop=0; $pageloop < 20; $pageloop++) { //ページループ
	    //while (!($page == 'Nothing')) {
	    	//dd('in loop');
	    	//$baseurl = 'https://stocks.finance.yahoo.co.jp/stocks/qi/?ids='
		    $html[$pageloop] = $baseurl. $gyousyu[$urlloop] .'&p='.$page;	//複数ページ
		    //$html = 'https://stocks.finance.yahoo.co.jp/stocks/qi/?ids=0050&p='.$page;	//ページ1のみ
		    //$html = 'http://stocks.finance.yahoo.co.jp/stocks/detail/?code='.$Realtime->code.$marketcode;
		    $client[$pageloop] = new Client();   //composer require fabpot/goutte しておくこと
		    $crawler[$pageloop] = $client[$pageloop]->request('GET', $html[$pageloop]);

		    //現在表示中のページのコード、マーケット、銘柄名を取得する
		    $table[$pageloop] = $crawler[$pageloop]->filter('#listTable > table');
		    //dd($table);
		    $code[$pageloop] = $table[$pageloop]->filter('td.center.yjM')->each(function ($node) {
					//#listTable > table > tbody > tr:nth-child(2) > td.center.yjM > a
		      $code_temp = $node->eq(0)->text();
		      return $code_temp;
		    });
		    //dd($code);
		    $market[$pageloop] = $table[$pageloop]->filter('td.center.yjSt')->each(function ($node) {
					//#listTable > table > tbody > tr:nth-child(2) > td.center.yjSt
		      $market_temp = $node->eq(0)->text();
		      return $market_temp;
		    });
		    //dd($market);
		    $name[$pageloop] = $table[$pageloop]->filter('strong.yjMt')->each(function ($node) {
					//#listTable > table > tbody > tr:nth-child(2) > td:nth-child(3) > strong
		      $name_temp = $node->eq(0)->text();
		      return $name_temp;
		    });
		    //dd($name);
		    
		    for($i=0; $i < count($code[$pageloop]); $i++) {
		    	$MeigaraCollection_temp = [
		    		"code" => $code[$pageloop][$i],
		    		"market" => $market[$pageloop][$i],
		    		"name" => $name[$pageloop][$i]
		    	];
		    	array_push($MeigaraCollection, $MeigaraCollection_temp);
		    }
		    //dd($MeigaraCollection);

		    //次ページの存在チェック
		    $nextastr[$pageloop] = $crawler[$pageloop]->filter('#listTable > div.yjListTab > p > span.listNext')->each(function ($node) {
		    //$nextastr = $crawler->filter('#listTable > div.yjListTab > p > span.listNext')->each(function ($node) {
		      //$nextastr_temp = $node->eq(0);
		      //$nextastr_temp = $node->eq(0)->text();
		      $check = $node->eq(0)->children()->nodeName();	//子要素をチェック
		      if ($check == 'a') {	//子要素がaの場合
			      $nextastr_temp = $node->filter('a')->eq(0)->attr('href');
		      } else {
		      	$nextastr_temp = 'Nothing';
		      }
		      return $nextastr_temp;
		    });
		    //dd($nextastr);

		    //var_dump($nextastr[$pageloop][0]);
		    if ($nextastr[$pageloop][0] === 'Nothing') {
		    	//次URLへ
		    	//dd('break');
			    $page = 'Nothing';
		    	break;
		    } else {
		    	//次ページへ
		      $startpos = mb_strpos($nextastr[$pageloop][0], 'p=');
		      $pagenum = mb_substr($nextastr[$pageloop][0], $startpos+2);
		    }
		    //dd($pagenum);
		    $page = $pagenum;
	    }	//ページループend
    }	//urlループend

	  //dd($MeigaraCollection);
	  //dd($MeigaraCollection);

  	//データベースを全削除
  	DB::table('meigaras')->delete();

  	/*
    $Meigaras = Meigara::all();
    foreach ($Meigaras as $meigara) {
	  	dd($meigara->find(1));
    	$meigara->find(1)->delete();
		} 
		*/
    //$Meigaras = Meigara::all()->delete();

    for ($i=0; $i < count($MeigaraCollection); $i++) { 
	    $meigara = new Meigara;
	    $meigara->code = $MeigaraCollection[$i]['code'];
	    $meigara->name = $MeigaraCollection[$i]['name'];
	    $meigara->market = $MeigaraCollection[$i]['market'];
			switch ($MeigaraCollection[$i]['market']) {
			    case "東証1部":
			        $marketcode = 1;
			        break;
			    case "東証2部":
			        $marketcode = 2;
			        break;
			    case "東証":
			        $marketcode = 3;
			        break;
			    case "東証外国":
			        $marketcode = 4;
			        break;
			    case "東証JQS":
			        $marketcode = 5;
			        break;
			    case "東証JQG":
			        $marketcode = 6;
			        break;
			    case "マザーズ":
			        $marketcode = 7;
			        break;
			    case "札証":
			        $marketcode = 8;
			        break;
			    case "札幌ア":
			        $marketcode = 9;
			        break;
			    case "福証":
			        $marketcode = 10;
			        break;
			    case "福岡Q":
			        $marketcode = 11;
			        break;
			    case "名証1部":
			        $marketcode = 12;
			        break;
			    case "名証2部":
			        $marketcode = 13;
			        break;
			    case "名古屋セ":
			        $marketcode = 14;
			        break;
		    default:
			        $marketcode = 15;
			}
	    $meigara->marketcode = $marketcode;
	    $meigara->save();
    }

    $Meigaras = Meigara::all();

    return view('meigaras.index', compact('Meigaras'));
  }

}

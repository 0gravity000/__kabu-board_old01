<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Realtime;
use App\User;
use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\Log;
use Mail;
use App\Mail\Established_value;
use App\Mail\Established_changerate;

class RealtimesController extends Controller
{

  public function __construct()
  {
    //$this->middleware('auth')->except(['index']);		//必要？
  }


  public function index()
  {
    if(Auth::check()) {
      //logining
      //dd(auth()->user()->id);
      $Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
      $users = User::where('id', auth()->user()->id)->get();
      //dd($users->first()->name);
      //$Realtimes = Realtime::all();
      //dd($Realtimes);
      /*
      foreach ($Realtimes as $Realtime) {
        $query = Meigara::where('code', $Realtime->code);
        $Realtime->name = $query->first()->name;
        $Realtime->market = $query->first()->market;
        $Realtime->marketcode = $query->first()->marketcode;
        $Realtime->save();
      }
      //dd($query->first()->name);
      */
      return view('realtimes.index', compact('Realtimes', 'users'));
      //return view('realtimes.index');
    } else {
      // Not login
      return view('realtimes.message');
    }
  }

  public function index_value()
  {
    if(Auth::check()) {
      $Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
      $users = User::where('id', auth()->user()->id)->get();
      return view('realtimes.index_value', compact('Realtimes', 'users'));
    } else {
      // Not login
      return view('realtimes.message');
    }
  }

  public function index_changerate()
  {
    if(Auth::check()) {
      $Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
      $users = User::where('id', auth()->user()->id)->get();
      return view('realtimes.index_changerate', compact('Realtimes', 'users'));
    } else {
      // Not login
      return view('realtimes.message');
    }
  }

  public function create()
  {
    return view('realtimes.create');
  }

  public function store()
  {
    $query = Realtime::where('code', request()->code)
      ->where('user_id', auth()->user()->id);
    //dd($query->first());
    if($query->first() == null) {
      //dd(request()->code);
      auth()->user()->publish(
        new Realtime(request(['code']))
      );
      //auth()->user()->publish(
      //  new Realtime(request(['code']))
      //);
      /*
      //dd(request()->code);
      $realtime = new Realtime;
      $realtime->code = request()->code;
      //$realtime->code = request(['code']);
      //dd(request(['code']));
      //dd($realtime);

      $query = Meigara::where('code', request()->code);
      $realtime->name = $query->first()->name;
      $realtime->market = $query->first()->market;
      $realtime->marketcode = $query->first()->marketcode;
      $realtime->user_id = auth()->user()->id;
      //$realtime->value = 0;

      $realtime->save();
      */
    }
    return redirect('/Realtimes');
  }

  public function reset()
  {
    if(Auth::check()) {
      $Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
      $users = User::where('id', auth()->user()->id)->get();
      //dd($Realtimes);
      foreach ($Realtimes as $Realtime) {
        $Realtime->sendflag = false;
        $Realtime->sendflag_changerate = false;
        $Realtime->changecount = 0;
        $Realtime->save();
      }
    } else {
      // Not login
    }
    return view('realtimes.index', compact('Realtimes', 'users'));
  }

  public function config_value()
  {
    $realtime = new Realtime;
    $realtime->code = request()->code;
    //dd(request()->code);
    $query = Meigara::where('code', request()->code);
    $query_r = Realtime::where('code', request()->code)
      ->where('user_id', Auth::id());
    //dd($query_r->first()->lowerlimit);

    $realtime->name = $query->first()->name;
    $realtime->market = $query->first()->market;
    $realtime->marketcode = $query->first()->marketcode;
    $realtime->value = $query_r->first()->value;
    $realtime->upperlimit = $query_r->first()->upperlimit;
    $realtime->lowerlimit = $query_r->first()->lowerlimit;
    //$realtime->changerate = $query_r->first()->changerate;

    return view('realtimes.config_value', compact('realtime'));
  }

  public function configed_value()
  {
    //$realtime = new Realtime;
    $Realtime = Realtime::where('code', request()->code)
      ->where('user_id', Auth::id())->first();
      //->where('user_id', auth()->user()->id);
    //dd($Realtime);

    if (request()->set == 'set') {
      //set
      //dd('set!!');
      //foreach ($Realtimes as $Realtime) {
      $Realtime->upperlimit = request()->upperlimit;
      if($Realtime->upperlimit != null){
        $time = date( "Y-m-d H:i:s" );
        $Realtime->ul_setat = $time;
      }

      $Realtime->lowerlimit = request()->lowerlimit;
      if($Realtime->lowerlimit != null){
        $time = date( "Y-m-d H:i:s" );
        $Realtime->ll_setat = $time;
      }

      $Realtime->sendflag = false;

    } else {
      //delete
      //dd('delete!!');
      //dd($Realtime);
      //$Realtime->delete();
      Realtime::where('code', request()->code)
        ->where('user_id', Auth::id())->first()->delete();
    }

    //dd($Realtime);
    $Realtime->save();
    //}
    return redirect('/Realtimes/value');
  }

  public function config_changerate()
  {
    $realtime = new Realtime;
    $realtime->code = request()->code;
    //dd(request()->code);
    $query = Meigara::where('code', request()->code);
    $query_r = Realtime::where('code', request()->code)
      ->where('user_id', Auth::id());
    //dd($query_r->first()->lowerlimit);

    $realtime->name = $query->first()->name;
    $realtime->market = $query->first()->market;
    $realtime->marketcode = $query->first()->marketcode;
    //$realtime->value = $query_r->first()->value;
    //$realtime->upperlimit = $query_r->first()->upperlimit;
    //$realtime->lowerlimit = $query_r->first()->lowerlimit;
    $realtime->changerate = $query_r->first()->changerate;
    $realtime->changerate_range = $query_r->first()->changerate_range;

    return view('realtimes.config_changerate', compact('realtime'));
  }

  public function configed_changerate()
  {
    //$realtime = new Realtime;
    $Realtime = Realtime::where('code', request()->code)
      ->where('user_id', Auth::id())->first();
      //->where('user_id', auth()->user()->id);
    //dd($Realtime);

    if (request()->set == 'set') {
      //set
      //dd('set!!');
      $Realtime->changerate_range = request()->changerate_range;
      if($Realtime->changerate_range != null){
        $time = date( "Y-m-d H:i:s" );
        $Realtime->cr_setat = $time;
      }
      $Realtime->sendflag_changerate = false;
      $Realtime->changecount = 0;

    } else {
      //delete
      //dd('delete!!');
      //dd($Realtime);
      //$Realtime->delete();
      Realtime::where('code', request()->code)
        ->where('user_id', Auth::id())->first()->delete();
    }

    //dd($Realtime);
    $Realtime->save();
    //}
    return redirect('/Realtimes/changerate');
  }

  public function update()
  {
    $a_temp;
    $b_temp;
    $c_temp;
    $d_temp;

    //$g_temp = array();
    //array_push($g_temp, 0);
    // Create Goutte Object
    if(Auth::check()) {
      //logining
      //var_dump("now login");
      //dd(auth()->user()->id);
      $client = new Client();   //composer require fabpot/goutte しておくこと
      $Realtimes = Realtime::where('user_id', auth()->user()->id)->get();
      //$Realtimes = Realtime::all();

      foreach ($Realtimes as $Realtime) {
        //dd($Realtime);
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
          //dd($Realtime);
          //dd($g_temp);
          //global $g_temp;
          //$g_temp = array();
          $g_temp;
          //銘柄名
          //dd($node->filter('th')->eq(0)->text());
          //現在値
          //dd($node->filter('td')->eq(1)->text());
          //前日比
          //dd($node->filter('span')->eq(1)->text());

          //dd($node->text());
          //echo $node->text() . "\n";
          //$inttemp = (int)$node->filter('td')->eq(1)->text();
          //$g_temp[] = 0;
          //$g_temp[] = $node->filter('td')->eq(1)->text();
          //dd($node->filter('td')->eq(1)->text());
          $g_temp = $node->filter('td')->eq(1)->text();
          //array_push($g_temp, $node->filter('td')->eq(1)->text());
          //dd($g_temp);
          //var_dump($g_temp);
          return $g_temp;
        });
        //dd($a_temp);

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
        //$b_temp = $crawler->filter('dl.tseDtl dd')->each(function ($node) {
          $g_temp;
          $g_temp = $node->filter('strong')->eq(0)->text();
          //dd($g_temp);
          return $g_temp;
        });
        //dd($b_temp);

        //高値時刻(2)、安値時刻(3)
        $c_temp = $crawler->filter('dd.ymuiEditLink span.date')->each(function ($node) {
          //$g_temp;
          //$g_temp = $node->filter('date')->eq(0)->text();
          $g_temp = $node->eq(0)->text();
          //$g_temp = $node->filter('span.date yjSt')->eq(0)->text();
          return $g_temp;
        });
        //dd($c_temp);

        //var_dump($a_temp);
        //dd($c_temp);
        //dd($a_temp[0]);
        //dd($a_temp);
        //var_dump($Realtime);
        //if (!$g_temp[($Realtime->id)-1] = "---") {
        //$Realtime->value = $g_temp[0];

        //現在値
        $number = str_replace(',','',$a_temp[0]);
        //dd($number);
        $Realtime->value = intval($number);

        //高値(2)、安値(3)
        $number = str_replace(',','',$b_temp[2]);
        //dd($number);
        $Realtime->uppervalue = intval($number);
        $number = str_replace(',','',$b_temp[3]);
        $Realtime->lowervalue = intval($number);

        //高値時刻(2)、安値時刻(3)
        $number = str_replace('（','',$c_temp[2]);
        $number = str_replace('）','',$number);
        $number = str_replace('/',':',$number);
        //$today = date("Y-m-d");
        if(ctype_digit($number)) {
          $time = new DateTime($number.':00');
          //dd($time);
          $Realtime->uv_updateat = $time;
        }
        $number = str_replace('（','',$c_temp[3]);
        $number = str_replace('）','',$number);
        $number = str_replace('/',':',$number);
        //$today = date("Y-m-d");
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

        Log::debug($Realtime->name);
        if($hitflag == true){
          Log::debug($hitflag);
          if($Realtime->sendflag == false){
            Log::debug($Realtime->sendflag);
            $Realtime->sendflag = true;
            $Realtime->save();
            //dd($Realtime->sendflag);
          //メール送信
            $users = User::where('id', $Realtime->user_id)->get();
            //dd($users, $Realtime);
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

     return redirect('/Realtimes');
     //return view('realtimes.index', compact('Realtimes'));
  }

}

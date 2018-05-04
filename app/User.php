<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function realtimes()
    {
      return $this->hasMany(Realtime::class);
    }

    public function publish(Realtime $realtime)
    {

      $query = Meigara::where('code', request()->code);
      $this->realtimes()->create([
        'code' => request()->code,
        'name' => $query->first()->name,
        'market' => $query->first()->market,
        'marketcode' => $query->first()->marketcode,
        'user_id' => auth()->user()->id,
        'changecount' => 0,
        'sendflag' => false,
        'sendflag_changerate' => false,
      ]);
      //dd($this->realtimes());
      //$this->realtimes()->save($realtime);

      //dd(request()->code);
//      $realtime = new Realtime;
//      $realtime->code = request()->code;
      //$realtime->code = request(['code']);
      //dd(request(['code']));
      //dd($realtime);

      /*
      $realtime = new Realtime;
      $query = Meigara::where('code', $code);
      $realtime->code = request()->$code;
      $realtime->name = $query->first()->name;
      $realtime->market = $query->first()->market;
      $realtime->marketcode = $query->first()->marketcode;
      $realtime->user_id = auth()->user()->id;
      //$realtime->value = 0;
      */

    }
    
}

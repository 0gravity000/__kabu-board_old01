<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realtime extends Model
{
  // 変更するかもしれないカラム  ここに宣言することで、初期値の設定が反映された
  protected $fillable = [
      'id', 'user_id', 'code', 'name', 'market', 'marketcode', 'value', 'pre_value',
      'uppervalue', 'uv_updateat', 'lowervalue', 'lv_updateat',
      'upperlimit', 'ul_setat', 'lowerlimit', 'll_setat',
      'changerate', 'pre_changerate', 'changecount', 'changerate_range', 'cr_setat',
      'sendflag', 'sendflag_changerate'
  ];

  // 絶対に変更しないカラム
  protected $guarded = [

  ];

    public function user()  // $realtime->user->name
    {
      return $this->belongsTo(User::class);
    }
}

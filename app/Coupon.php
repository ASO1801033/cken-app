<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    // 絶対に変更しないカラム
    protected $guarded = ['id', 'user_id'];

    // 変更するかもしれないカラム
  protected $fillable = ['contents', 'coupontitle'/*, 'startdate', 'finishdate', 'flg'*/];

    //外部キー(user_id)に対応するデータを取得するメソッド
    public function user() {
        // belongsTo()メソッドの引数にモデル(クラス名)を指定する
        return $this->belongsTo('App\User');
    }
}

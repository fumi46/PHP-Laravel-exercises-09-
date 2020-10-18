<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
        );
        
    // History モデルとの関連付け
    public function histories()
    {
        return $this->hasMany('App\History');  //Newsモデルに関連しているHistoryモデルの中の全てのテーブルを取得。
    }
}

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
        return $this->hasMany('App\History');  //Newsモデルが多くのモデルと関連している。Historyモデルはその内の一つ。
    }
}

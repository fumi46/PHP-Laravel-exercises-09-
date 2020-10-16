<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $gurded = array('id');  //不可変情報
    
    public static $rules = array(
        'news_id' => 'required',
        'edited_id' => 'required',
        );
}

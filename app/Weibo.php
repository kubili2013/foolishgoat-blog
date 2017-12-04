<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weibo extends Model
{
    protected $table = 'weibo';
    protected $fillable = ['id','weibo_id','index_url','user_id'];
    public $incrementing = false;

    public function user(){
        return $this->belongsTo("App\\User");
    }
}

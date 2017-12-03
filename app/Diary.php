<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diary extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected  $fillable = [
        'content',
        'tags',
        'user_id'
    ];


    public function user(){
        return $this->belongsTo('App\\User');
    }

    public function list_tags(){
        return explode(',',$this->tags);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use SoftDeletes;
    protected $table = "collections";
    protected $dates = ['deleted_at'];
    protected  $fillable = [
        'title',
        'content',
        'tags',
        'type',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\\User');
    }

    public function list_tags(){
        return explode(',',$this->tags);
    }
}

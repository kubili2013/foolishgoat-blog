<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    protected  $fillable = [
        'title',
        'thumbnail',
        'view_number',
        'upvote_number',
        'content_id',
        'is_top',
        'is_essence',
        'user_id',
        'publish'
    ];

    public function user(){
        return $this->belongsTo('App\\User');
    }

    public function content(){
        return $this->hasOne('App\\Content');
    }

    public function tags(){
        return $this->belongsToMany('App\\Tag');
    }

    public function comments()
    {
        return $this->morphMany('App\\Comment', 'commentable');
    }

    public function upusers(){
        return $this->belongsToMany('App\\User', 'upvote', 'article_id', 'user_id');
    }
}

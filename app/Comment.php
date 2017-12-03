<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected  $fillable = [
        'body',
        'commentable_id',
        'commentable_type',
        'user_id'
    ];

    public function comments()
    {
        return $this->morphMany('App\\Comment', 'commentable');
    }

    public function user()
    {
        return $this->belongsTo('App\\User');
    }
}

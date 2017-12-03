<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'content',
        'markdown_content',

        'article_id',
    ];

    public function article(){
        return $this->belongsTo('App\\Article');
    }
}

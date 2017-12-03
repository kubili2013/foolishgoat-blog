<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'tags'
    ];

    public function articles()
    {
        return $this->belongsToMany("App\\Article");
    }
}

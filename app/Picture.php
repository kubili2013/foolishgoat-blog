<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Picture extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    protected  $fillable = [
        'path',
        'user_id',
        'type'
    ];
}

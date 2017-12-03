<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Github extends Model
{
    protected $table = 'github';
    protected $fillable = ['github_id','index_url','user_id'];
    public $incrementing = false;

    public function user(){
        return $this->belongsTo("App\\User");
    }

}

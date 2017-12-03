<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar',
        'birth','real_name','phone_number'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','real_name','phone_number'
    ];

    public function articles(){
        return $this->hasMany('App\\Article');
    }

    public function weibo(){
        return $this->hasMany('App\\Weibo','user_id');
    }

    public function github(){
        return $this->hasMany('App\\Github','user_id');
    }

    public function comments(){
        return $this->hasMany('App\\Comment');
    }

    public function collections(){
        return $this->hasMany('App\\Collection');
    }

    public function diaries(){
        return $this->hasMany('App\\Diary');
    }
}

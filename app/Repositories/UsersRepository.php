<?php

namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: kubili2013
 * Date: 2017/8/30
 * Time: 下午3:06
 */
use App\Github;
use App\User;
use App\Weibo;
use Illuminate\Support\Facades\Crypt;

class UsersRepository
{
    /**
     * 根据 Github user 用户信息,创建本站用户
     * @param $githubUser
     */
    public function createUserUseGithub($githubUser){
        $user = new User();
        $user->name = $githubUser->nickname;
        $user->email = $githubUser->email;
        $user->password = Crypt::encrypt(str_random(32));
        $user->avatar = $githubUser->avatar;
        $user->save();
        $github = new Github();
        $github->id = $githubUser->id;
        $github->github_id = $githubUser->id;
        $github->index_url = $githubUser->original['url'];
        $user->github()->save($github);
        return $user;
    }

    /**
     * 根据 github id 查找用户实例
     * @param $github_id
     */
    public function getGitHubUser($github_id){
        return Github::where('github_id',$github_id)->first();
    }
    /**
     * 根据 weibo id 查找用户实例
     * @param $github_id
     */
    public function getWeiboUser($weibo_id){
        return Weibo::where('weibo_id',$weibo_id)->first();
    }

}
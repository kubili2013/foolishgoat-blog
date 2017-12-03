<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\Repositories\UsersRepository;

class ThirdPartyAuthController extends Controller
{
    protected  $repoUser;
    public function __construct(UsersRepository $up){

        $this->repoUser = $up;
    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($name)
    {
        return Socialite::driver($name)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($name)
    {
        $tUser = Socialite::driver($name)->user();
        if($name == 'github'){
            $gUser = $this->repoUser->getGitHubUser($tUser->id);
            if(!$gUser){
                //不存在 入库 登录
                Auth::login($this->repoUser->createUserUseGithub($tUser),true);
            }else{
                Auth::login($gUser->user, true);
            }
        }else if($name == 'weibo'){
            $wUser = $this->repoUser->getWeiboUser($tUser->id);
            if(!$wUser){
                //不存在 新建用户登录
                $this->repoUser->createUserUseWeibo($wUser);
            }
            Auth::login($wUser->user, true);
        }
        return redirect('/');
    }
}
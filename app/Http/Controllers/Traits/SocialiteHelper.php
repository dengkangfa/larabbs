<?php

namespace App\Http\Controllers\Traits;

use App\Models\User;
use Auth;
use Socialite;
use Illuminate\Http\Request;

trait SocialiteHelper
{
    protected $oauthDrivers = ['github' => 'github', 'wechat' => 'wechat'];

    public function oauth(Request $request)
    {
        $driver = $request->driver;
        $driver = $this->oauthDrivers[$driver] ?? 'github';

        return Socialite::driver($driver)->redirect();
    }

    public function callback(Request $request)
    {
        $driver = $request->driver;

        if (!isset($this->oauthDrivers[$driver])) {
            return redirect('/');
        }

        $oauthUser = Socialite::with($driver)->user();
        $user = User::getByDriver($driver, $oauthUser->id);
        if (Auth::check()) {
            if ($user && $user->id != Auth::id()) {
                $state = 'danger';
                $message = '对不起，这个社交帐户已经注册。';
            } else {
                $this->bindSocialiteUser($oauthUser, $driver);
                $state = 'success';
                $message = "绑定成功！以后可以使用你的 {$driver} 账号登录 LaraBBS 了 ^_^";
            }
            return redirect()->route('users.edit', Auth::id())->with($state, $message);
        } else {
            if ($user) {
                return $this->userFound($user);
            }
            return $this->userNotFound($driver, $oauthUser);
        }
    }

    public function bindSocialiteUser($oauthUser, $driver) {
        $currentUser = Auth::user();

        if ($driver == 'github') {
            $currentUser->github_id = $oauthUser->user['id'];
            $currentUser->github_url = $oauthUser->user['html_url'];
            $currentUser->github_name = $oauthUser->nickname;
        }
        $currentUser->save();
    }
}
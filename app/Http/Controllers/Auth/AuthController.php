<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\StoreUserRequest;
use Auth;
use Session;
use App\Models\User;
use App\Http\Controllers\Traits\SocialiteHelper;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use SocialiteHelper;

    /**
     * 第三方登录时，该driver用户未对应任何用户时，创建新用户
     *
     * @param $driver
     * @param $registerUserData
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userNotFound($driver, $registerUserData)
    {
        if ($driver == 'github') {
            $oauthData['github_id'] = $registerUserData->user['id'];
            $oauthData['github_url'] = $registerUserData->user['html_url'];
            $oauthData['github_name'] = $registerUserData->nickname;
            $oauthData['name'] = $registerUserData->name;
            $oauthData['email'] = $registerUserData->email;
            $oauthData['avatar'] = $registerUserData->avatar;
        }
        $oauthData['driver'] = $driver;
        // 将用户需要的数据存入 session
        Session::put('oauthData', $oauthData);
        return redirect(route('signup'));
    }

    /**
     * 新建通过第三方过来的用户
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (! Session::has('oauthData')) {
            return redirect()->route('login');
        }
        $oauthData = array_merge(Session::get('oauthData'), Session::get('_old_input', []));
        return view('auth.signupconfirm', compact('oauthData'));
    }

    public function createNewUser(StoreUserRequest $request)
    {
        if (! Session::has('oauthData')) {
            return redirect()->route('login');
        }
        $oauthUser = array_merge(Session::get('oauthData'), $request->only('name', 'email', 'password'));
        $userData = array_only($oauthUser, array_keys($request->rules()));
        $user = User::create($userData);
        return $this->userCreated($user);
    }

    public function userCreated($user)
    {
        Auth::login($user, true);
        Session::forget('oauthUser');

        return redirect()->route('users.edit', $user->id)->with('success', '欢迎加入LaraBBS');
    }

    public function userFound($user)
    {
        Auth::login($user, true);
        Session::forget('oauthUser');

        return redirect()->route('users.edit', $user->id)->with('success', '欢迎回来');
    }
}

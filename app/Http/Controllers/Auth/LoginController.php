<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
//处理用户认证
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //登录限制
    //如果你使用 Laravel 内置的 LoginController，则「记住」用户的逻辑已经由控制器使用的 traits 来实现。
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';//自定义路径

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //redirectTo 方法优先于 redirectTo 属性
    protected function redirectTo()
    {
        return '/';
    }

    //Laravel 默认使用 email 字段来认证。如果你想用其他字段认证，可以在 LoginController 里面定义一个 username 方法
    //方法名必须用username,用其他没有效果
    public function username()
    {
        return 'name';//这里是用于登录的字段名,文档里不明确;另外,视图不会自动修改,需要手动修改字段名
    }

    //自定义看守器,先不管
/*    protected function guard()
    {
        return Auth::guard('name');
    }*/

    //手动认证用户#
    /**
     * 处理身份认证尝试.
     *
     * @return Response
     */
    public function authenticate()
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // 认证通过...
            return redirect()->intended('dashboard');
        }
        //在这些例子中，email 不是必需的选项，仅作为示例使用。你应该使用与数据库中的「用户名」对应的任何字段的名称。

        //指定额外条件#
/*        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            // 用户处于活动状态，不被暂停，并且存在。
        }*/
    }
}

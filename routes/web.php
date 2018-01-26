<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user',function(Request $request){
    // 登录并且「记住」给定用户...
    Auth::login(Auth::user(), true);
    //通过 ID 验证用户#
    //登录并且「记住」给定的用户...
    Auth::loginUsingId(1, true);
    return [
        //检索认证用户
        'user'=>Auth::user() ?? null,
        'id'=>Auth::id() ?? '',
        'request'=>$request->user() ?? null,
        //确定当前用户是否认证
        'auth'=>Auth::check() ?? null,
        'via'=>Auth::viaRemember() ?? null,
    ];
});

Route::get('protect', function () {
    // 只有认证过的用户可以...
    // 未认证用户跳转登录
})->middleware('auth');

//注销用户#
Route::get('logout',function(){
    Auth::logout();
});
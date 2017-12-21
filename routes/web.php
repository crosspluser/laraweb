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



Route::get( '/', function(){
    return view( 'welcome' );
} );



//获取旧输入
Route::get( '/flash', function( Request $request ){
    //读取
    $param = [
        //请求属性：路径、方法等
        'fullUrl' => $request->fullUrl(),
        'method'  => $request->method(),
        //预处理&规范化
        'all'     => $request->all(),//参数
        'input'   => $request->input(),
        //旧输入
        'old'     => $request->old(),
    ];

    //旧输入
    $request->flash();//上一次
    //$request->flashOnly('flashOnly');//会覆盖上一句
    //$request->flashExcept('flashExcept');//会覆盖上一句

    //返回
    return $param;

} )->name( 'flash' );



//获取旧输入- Blade 模板
Route::get( '/flash-view', function( Request $request ){
    //读取
    $return = view( 'welcome' );

    //旧输入
    //$request->flash();//注释后，闪现一次

    //返回
    return $return;//几乎等价于传值；区别是停止flash后，还能使用一次，刷新后下一次消失；可以用于一次行为场景
} )->name( 'flash.view' );



//请求重定向
Route::get( '/request-redirect', function( Request $request ){
    return redirect( 'flash' )->withInput( $request->except( 'except' )//转发参数
    );
} );



//从请求中获取 Cookie
Route::get( '/cookie', function( Request $request ){
    //全局cookie函数
    //$cookie = cookie('name', 'value', 1);
    //return response('Hello World')->cookie($cookie);

    //返回
    return [
        'cookie'=>cookie(),//postman可能发送不了浏览器的cookie
        'request-cookie' => $request->cookie(),//可能只是laravel实现的
        'response' => response('Hello World')->cookie('name', 'value', 1)
    ];
    //总之，为了解决和页面（模板）间传值需求
} )->name( 'cookie' );

/**
 * 总结
 */

/**
 * 待续
 */
//psr-7请求：一种更开放的接口标准，可以是各种请求格式，用到再研究
//cookie：通用cookie因为安全机制被拦截，laravel实现了自己的，用到再研究
//存储上传文件:与存储系统一并研究
//配置可信代理:等用到时一并研究
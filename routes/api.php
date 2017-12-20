<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//获取请求：1、自动注入 服务容器；2、路由参数 在 服务容器 之后；
Route::any( '/request', function( Request $request ){

    return [
        //请求属性：路径、方法等
        'path'     => $request->path(),
        'url'      => $request->url(),
        'fullUrl'  => $request->fullUrl(),
        'method'   => $request->method(),
        'is'       => $request->is( 'reQuest' ),//路由判断：区分大小写
        'isMethod' => $request->isMethod( 'GeT' ),//方法判断：不区分大小写
        //预处理&规范化
        'all' => $request->all(),//参数
        'query' => $request->query(),//查询：只获取跟随url提交的query，不获取表单等形式提交的；
        'param_default' => $request->input('param_default','param_default'),//参数
        'array' => $request->input('array.*'),//数组：数字取偏移；*号取全部
        'temp' => $request->temp,//动态：先请求数据，再路由参数
        'json' => $request->input('key'),//json：自动解析成对象；标准json格式应该用双引号
        'only'=>$request->only(['temp']),
        'except'=>$request->except(['temp']),
        'has'=>$request->has('has','temp'),
        'filled'=>$request->filled('filled','has'),
    ];
} )->name('');

//PSR-7 请求：一种更开放的接口标准，用到再研究
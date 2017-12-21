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

use Illuminate\Support\Facades\Cookie;

Route::get( '/', function(){
    return view( 'welcome' );
} );

//字符串
Route::get( '/string', function(){
    return 'string';
} );

//数组
Route::get( '/array', function(){
    return [
        'A' => 'a',
        'R' => 'r',
        'Y' => 'y',
    ];
} );

//响应对象
Route::get( '/response', function(){
    return response( 'response', 200 )->header( 'Content-Type', 'text/plain' );//text/html text/json
} );

//为响应增加头信息
Route::get( 'header', function(){
    //return response( 'header' )->header( 'Content-Type', 'text/plain' )->header( 'X-Header-1', 'Header 1' )->header( 'X-Header-2', 'Header 2' );//暂未发现区别

    return response( 'header' )->withHeaders( [
        'Content-Type' => 'text/plain',
        'X-Header-1'   => 'Header 1',
        'X-Header-2'   => 'Header 2',
    ] );
} );

//为响应增加 Cookie
Route::get( 'cookie', function(){
    return response( 'cookie' )->header( 'Content-Type', 'text/plain' )->cookie( 'customize', 'value', 100 );//postman默认不会更新cookie,可使用浏览器;修改value
} );

//重定向
Route::get( 'redirect', function( \Illuminate\Http\Request $request ){
    if( url()->previous() != route( 'redirect' ) )
        return [
            'previous' => url()->previous(),//显示跳转前页面
            'request'  => $request
        ];

    return redirect( '/back' );//这样是路由
    //return redirect()->route('back', ['id' => 1]);//这样是命名
    //return redirect()->route('back', [$user]);//模型参数,会自动提取id,详细参考路由
} )->name( 'redirect' );
//重定向back
Route::get( 'back', function( \Illuminate\Http\Request $request ){
    return back()->withInput();//使用时注意,如果是post方法且没有withInput,是否带参数
} );

//闪存重定向
Route::get( 'with', function( \Illuminate\Http\Request $request ){
    return redirect( '/session' )->with( 'with', 'with' );
} );
//读取闪存
Route::get( 'session', function( \Illuminate\Http\Request $request ){
    return session( 'with' );
} );

//视图响应
Route::get( 'view', function( \Illuminate\Http\Request $request ){
    return response()->view( 'welcome', [], 404 )->header( 'Content-Type', 'text/plain' );
} );

//json响应
Route::get( 'json', function( \Illuminate\Http\Request $request ){
    return response()->json( [
        'json'  => 'json',
    ] );
} );
//jsonp响应
Route::get( 'jsonp', function( \Illuminate\Http\Request $request ){
    return response()->json( [
        'json'  => 'json',
    ] )->withCallback($request->input('__callback'));//__callback自定义,收发一致即可
} );

//文件下载 响应
Route::get('download',function(){
    return response()->download('css/app.css','样式');//可以传header,;可以设置deleteFileAfterSend(true),以删除临时文件等
});

/**
 * 待续
 */
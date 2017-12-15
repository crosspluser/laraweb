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

Route::get( '/', function(){
    return view( 'welcome' );
} );

//基本路由：URI+闭包
Route::get( 'foo', function(){
    return 'foo';
} );

Route::put( 'form_method', function(){
    return 'form_method';
} );

//匹配路由
Route::match( [ 'get', 'post' ], '/match', function(){
    return 'match';
} );
Route::any( '/any', function(){
    return 'any';
} );

//重定向路由
Route::redirect( '/redirect', 'foo', 301 );

//视图路由
Route::view( '/view', 'view', [ 'name' => 'Lara' ] );

//路由参数
//必填参数：1、问号确保找路由，默认值确保不抛错，两者不同，2、正则约束失败也不改变匹配优先级，短路由依然优先，会提示找不到路由而不是匹配长路由
Route::get( '/param/{p1?}', function( $p1 = '' ){
    return 'param=' . $p1;
} )->where( 'p1', '[0-9]+' );
//多个参数：短路由优先
Route::get( '/param/{p1?}/more/{p2?}', function( $p1 = '', $p2 = '' ){
    return 'p1=' . $p1 . ' p2=' . $p2;
} );
//可选参数：
Route::get( 'param_select/{p1?}', function( $p1 = '' ){
    return $p1;
} );
//正则约束

//命名路由：路由名不包括参数
Route::get( '/name/{p1?}', 'UserController@name' )->name( 'name' );
//命名路由转发：如果转发多个参数，第一个匹配路由，后面的按顺序拼接?&
Route::get( '/name_redirect/{p1?}', function( $p1 = '' ){
    return redirect()->route( 'name', [ $p1, 'add' => $p1 ] );
} );

//路由组
//中间件：可以重复，必须命名
Route::middleware( [ 'web', 'web' ] )->group( function(){
} );
//命名空间：针对控制器
Route::namespace( 'Admin' )->group( function(){
    //Admin=App\Http\Controllers\Admin
} );
//子域名路由：可以匹配使用
Route::domain( '{account}.laravel.com' )->group( function(){
    Route::get( 'subdomain', function( $account ){
    } );
} );
//路由前缀
Route::prefix( 'admin' )->group( function(){
} );

//路由模型绑定
//隐式绑定：默认只能用ID，可以在模型里用方法指定字段
Route::get( 'user/{user}', function( App\User $user ){
    return $user;
} );
//显式绑定：没发现区别，一样受model方法影响
Route::get( 'user2/{user}', function( App\User $user ){
    return $user;
} );
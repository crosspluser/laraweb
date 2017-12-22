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

use Illuminate\Support\Facades\URL;

Route::get( '/', function(){
    return view( 'welcome' );
} );

Route::get( 'show2/{id}', 'UserController@show' );
Route::get( 'show3/{id}', 'UserController@show' );

//Route::resource( 'users', 'UserController' );

//URL生成
Route::get( 'url', function(){
    $user = App\User::find( 1 );

    return [
        'url'           => url( "/users/{$user->name}" ),//注意用双引号;会被自动处理,加大括号更能区分
        'current'       => url()->current(),
        'full'          => URL::full(),
        'previous'      => URL::previous(),
        'previous_name' => route( 'previous', [ 'param' => 1 ] ),
        'action'        => action( 'UserController@show', [ 'id' => 1 ] ),//自动反向映射;当同一个控制器对应多个路由时,以最后生效为准
    ];
} );

//前一页:跳转前
Route::get( 'previous', function(){
    return redirect( '/url' );
} )->name( 'previous' );

//默认值-访问
Route::get( 'locale', function(){
    return route('post.index');
} );

//默认值
Route::get( '/{locale}/posts', function( $locale ){
    return $locale ?? '';
} )->name( 'post.index' );

/**
 * 难点
 */
//默认:文档不详细,自己试验;仔细阅读文档含义"在使用辅助函数 route 生成 ",得到别的路由调用的信息
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

use App\User;

Route::get( '/', function(){
    return view( 'welcome' );
} );


//模板继承
//定义布局
//继承布局
Route::get( 'blade', function(){
    return view( 'child' );
} );
//Components & Slots
Route::get( 'component', function(){
    return view( 'component' );
} );
//有时为组件定义多个 slots 是很有帮助的
Route::get( 'component2', function(){
    return view( 'component2' );
} );


//显示数据
Route::get( 'greeting', function(){
    return view( 'welcome', [ 'name' => 'nickname' ] );
} );
//显示未转义的数据
Route::get( 'html', function(){
    return view( 'html', [ 'html' => '<h1>Title</h1>' ] );
} );
//渲染 JSON
Route::get( 'json', function(){
    return view( 'json', [ 'array' => [ 'key' => 'value' ] ] );
} );


//Blade & JavaScript 框架--指前端框架,避免与前端框架里的{{}}冲突
Route::get( 'javascript', function(){
    return view( 'javascript' );
} );


//流程控制
Route::get( 'var', function(){
    $users = User::all();
    $array = [ null, '', [], false, true, 0, 1, 2 ];

    return view( 'var', [
        'var'   => $array[ random_int( 0, count( $array ) - 1 ) ],
        'array' => $array,
        'users' => $users,
        'bool'  => false,//true会死循环,导致模板一直没有输出值
    ] );
} );

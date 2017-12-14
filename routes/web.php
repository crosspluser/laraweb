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
Route::get( '/name/{p1?}', function( $p1 = '' ){
    return [ $p1, route( 'name' ) ];
} )->name( 'name' );
//命名路由转发：转发多个参数
Route::get( '/name_redirect/{p1?}', function( $p1 = '' ){
    return redirect()->route( 'name', [ $p1, 'add' => $p1 ] );
} );
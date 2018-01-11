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

Route::get( 'vue', function(){
    return view( 'vue' );
} );

Route::get( 'vue-5538', function(){
    return view( 'vue-5538' );
} );

Route::get( 'vue-5578', function(){
    return view( 'vue-5578' );
} );

Route::get( 'vue-5606', function(){
    return view( 'vue-5606' );
} );

Route::get( 'vue-5621', function(){
    return view( 'vue-5621' );
} );

/**
 * Q&A
 */
//npm install报错: 退出, 第二天重新执行, 自动好了, 可能与环境有关
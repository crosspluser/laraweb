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

//确定当前语言环境
Route::get( 'locale', function(){
    App::setLocale( 'en' );//区域设置,可以覆盖全局设置

    return [
        'locale'     => App::getLocale( 'zh' ),
        'isLocaleEn' => App::isLocale( 'en' ),
        'isLocaleZh' => App::isLocale( 'zh' ),
    ];
} );

Route::get( 'view', function(){
    echo __( 'messages.welcome' ) . '<br />';//使用翻译字符串作为键//lang/zh/messages.php
    echo __( 'messages.give me a json message' ) . '<br />';//使用翻译字符串作为键//json
    echo __( 'give me a json' ) . '<br />';//使用翻译字符串作为键//json
    echo __( 'key no found 键不存在' ) . '<br />';//不存在这个键,直接返回
    echo __( 'messages.json', [ 'json' => 'hi' ] ) . '<br />';//不存在这个键,直接返回
    echo trans_choice( 'messages.apples', 10 ) . '<br />';//转换选择,复数必须用这个?

    return view( 'view' );
} );

//git config core.autocrlf false
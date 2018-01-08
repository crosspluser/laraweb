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
    App::setLocale('en');//区域设置,可以覆盖全局设置
    return [
        'locale' => App::getLocale( 'zh' ),
        'isLocaleEn' => App::isLocale( 'en' ),
        'isLocaleZh' => App::isLocale( 'zh' ),
    ];
} );

Route::get( 'view', function(){
    echo __('messages.welcome');
    echo '<br />';
    echo __('give me a json');
    return view('view');
} );
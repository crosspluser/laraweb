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

use Illuminate\Support\Facades\View;

Route::get( '/', function(){
    return view( 'welcome' );
} );

//创建视图
Route::get( 'view', function(){
    return view( 'view', [
        'filename' => 'view.blade.php',
        'exists'   => View::exists( 'view' ),
    ] )->with( 'with', 'with' );//向视图传递数据
} );

//视图合成器
Route::get( 'profile', function(){
    return view( 'profile');
} );
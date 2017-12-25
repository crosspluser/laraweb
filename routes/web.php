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

use Illuminate\Http\Request;

Route::get( '/', function(){
    return view( 'welcome' );
} );

//会话机制
Route::resource( 'users', 'UserController' );

//flash
Route::get( 'flash/{flash?}', function( Request $request, $flash = 'flash' ){
    $request->session()->flash( 'flash', $flash );

    return redirect( '/session' );
} );

//reflash
Route::get( 'reflash/{flash?}', function( Request $request, $flash = 'flash' ){
    $request->session()->reflash(   );      //没有效果,可能是给前进后退用的

    return redirect( '/session' );
} );

//keep
Route::get( 'keep/{flash?}', function( Request $request, $flash = 'flash' ){
    $request->session()->keep( [ 'flash'=> $flash ] );//只在old里出现,不出现在字段里

    return redirect( '/session' );
} );

//session
Route::get( 'session', function( Request $request ){
    $return = [
        'session' => $request->session()->all(),
    ];

    return $return;
} );

/**
 * 问题
 */
//reflash:没有用,传不了值,可能是前进后退用的
//自定义session驱动:用mongo等自行实现

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

//获取旧输入
Route::get( '/flash', function( Request $request ){
    //旧输入
    //$request->flash();
    //$request->flashOnly('flashOnly');
    //$request->flashExcept('flashExcept');

    return [
        //请求属性：路径、方法等
        'fullUrl'  => $request->fullUrl(),
        'method'   => $request->method(),
        //预处理&规范化
        'all' => $request->all(),//参数
        'input' => $request->input(),
        //旧输入
        'old'=>$request->old()
    ];
} )->name('flash');

//请求重定向
Route::get( '/request-redirect', function( Request $request ){
    return redirect('flash')->withInput(
        $request->except('except')//转发参数
    );
} );
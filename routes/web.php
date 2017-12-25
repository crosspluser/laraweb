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

Route::resource( 'users', 'UserController' );

//编写验证逻辑
//空白原因:如果错误,laravel自动回退提交页,所以拿不到错误数据;如果需要打印错误信息,可用给ajax请求得到json,,或使用make验证
//postman发送ajax:Content-Type设置为application/json,X-Requested-With设置为XMLHttpRequest,laravel会返回422状态的json,不会重定向
Route::post( 'validate', function( \Illuminate\Http\Request $request ){
    //return [ 'empty' => $request->input( 'empty' ) ];//
    //显示验证错误
    $request->validate( [
        'name'     => 'bail|required|unique:users,id|min:1',//bail第一次验证失败后停止
        'password' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );//参数1:字段数组;参数2:信息数组

    return [
        'request'  => $request,
        'name'     => $request->input( 'name' ),
        'password' => $request->input( 'password' ),
    ];
} );

Route::post( 'make/request', function( App\Http\Requests\User\Insert $request ){
    return [
        'request'  => $request,
        'name'     => $request->input( 'name' ),
        'password' => $request->input( 'password' ),
    ];
} );

/**
 * question
 */
//页面空白或拿不到错误数据:使用make,构造ajax,或表单提交.
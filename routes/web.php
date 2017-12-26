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

use Illuminate\Support\Facades\Validator;

Route::get( '/', function(){
    return view( 'welcome' );
} );

Route::resource( 'users', 'UserController' );

Route::get( 'view', function(){
    return view( 'view' );
} );

Route::get( 'error', function(){
    return view( 'error' );
} );

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

//表单请求验证
//搭配使用
Route::post( 'make/request', function( App\Http\Requests\User\Insert $request ){
    return [
        'request'  => $request,
        'name'     => $request->input( 'name' ),
        'password' => $request->input( 'password' ),
    ];
} );

//手动创建验证器
Route::post( 'make', function( \Illuminate\Http\Request $request ){
    //$validator = Validator::make( $request->all(), [ 'name' => 'required' ] )->fails();
    $validator = Validator::make( $request->all(), [ 'name' => 'required' ] );//可以连续使用
    if( $validator->fails() ){
        return 0;//redirect('post/create')->withErrors($validator)->withInput();//如果跳转,带上错误和输入
    }

    return 1;
} );

//手动创建验证器-自动重定向
//或返回json
Route::post( 'make/request', function( \Illuminate\Http\Request $request ){
    Validator::make( $request->all(), [
        'name'     => 'required',
        'password' => 'required',
    ] )->validate();
} );

//命名错误包
Route::post( 'make/request/with/error', function( \Illuminate\Http\Request $request ){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );

    $validator->after( function( $validator ){//后钩子,后置中间件,等价于新建类的withValidator
        $validator->errors()->add( 'after', 'after field' );//添加字段
    } );

    if( $validator->fails() ){
        return redirect( 'error' )->withErrors( $validator, 'login' );//->withInput()影响输入值,不影响报错
    }
} );

//验证后钩子
Route::post( 'make/request/after', function( \Illuminate\Http\Request $request ){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
    ], [
        'name.required'     => ':attribute 必须传入',
        'password.required' => ':attribute 必须传入',
        //'array.key' => ':attribute 必须传入',//嵌套数组
    ] );

    $validator->after( function( $validator ){//后钩子,后置中间件,等价于新建类的withValidator
        $validator->errors()->add( 'after', 'after field' );//添加字段
    } );

    if( $validator->fails() ){
        $validator->validate();
    }
} );

//处理错误消息
Route::post( 'errors', function( \Illuminate\Http\Request $request ){
    $validator = Validator::make( $request->all(), [
        'name' => 'required',
    ], [
            'required'          => ':attribute 必须传入',//自定义错误消息
            'name.required'     => ':attribute 必须传入',//为给定属性指定自定义消息
            'password.required' => ':attribute 必须传入',
            //'array.key' => ':attribute 必须传入',//嵌套数组
        ] );
    $errors = $validator->errors();
    $return = [
        'errors' => $errors,//错误消息
        'all'    => $errors->all(),//查看所有字段的错误消息
        'first'  => $errors->first( 'name' ),//查看特定字段的第一个错误消息
        'get'    => $errors->get( 'name' ),//查看特定字段的所有错误消息
        'has'    => $errors->has( 'name' ),//判断特定字段是否含有错误消息
        //'array'    => $errors->get( 'array.*' ),//验证表单的数组字段
    ];

    return $return;
} );


/**
 * question
 */
//页面空白或拿不到错误数据:使用make,构造ajax,或表单提交.
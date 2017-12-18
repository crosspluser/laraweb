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

//单个行为控制器：一定是全名，注意带上Controller后缀
Route::get( 'user/invoke/{id?}', 'UserInvokeController' );

//补充资源控制器：应放在Route::resource之前，否则有可能被默认值优先
Route::get( 'users/test', 'UserController@test' );

//资源控制器：不存在、排除等会空白但不会报错
Route::resource( 'users', 'UserController', [
    'except' => [
        'except'
    ],
    //命名资源路由：注意，要加key=names，且本数组会覆盖默认命名
    'names'=>['create'=>'users.build'],
    //命名资源路由参数：////如何影响参数？待细化研究
    //'parameters' => [ 'user' => 'user' ],
] );

//API资源路由：排除view业务
Route::apiResources( [
    'user' => 'UserController',
    //可以追加更多控制器
]);

//php artisan route:cache 闭包报错
//php artisan route:clear 刷新路由


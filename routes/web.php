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

Route::get('/', function () {
    return view('welcome');
});

//路由中间件
//完整类名：连续方法可以后置，可以指定class
Route::get('mid', function(){
    return 'mid';
})->middleware(App\Http\Middleware\CheckAge::class);
//中间件参数：目前知道，只能手工冒号指定，不能自动匹配参数
Route::get('mid_param', function(){
    return 'mid_param';
})->middleware('check:check_param');



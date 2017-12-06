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

Route::get('foo', function () {
    //dd(Route::current());//当前路由
    dd(Route::currentRouteName());//当前路由名字（不是url，是自定义名字）
    //return route('foo-get',['id'=>1]);//查看路由地址及参数
    return 'GET foo';
})->name('foo-get');

Route::get('foo/action', 'UserController@index')->name('foo_action-get');

Route::put('foo', function () {
    return 'PUT foo';
})->name('foo-put');

Route::post('foo', function () {
    return 'POST foo';
});

//视图路由
Route::view('welcome', 'welcome-name', ['name' => 'Taylor']);

//正则路由
Route::get('name/{id}/{name}', function($name){
    return $name;
})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

//路由组+中间件
Route::middleware(['first'])->group(function(){
});

//路由组+命名空间
Route::namespace('First')->group(function(){
});

//路由组+子域名
Route::domain(['{account.app.com}'])->group(function(){
});

//路由组+前缀
Route::prefix('admin')->group(function(){
});

//路由绑定模型
Route::get('user/{user}',function(App\Models\User $user){
   return $user;
});







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

//CSRF：会提示过期，前后端分离时注意通讯协议
Route::get('/csrf',function(){
    return view('csrf');
});

//CSRF白名单
Route::post('/csrf/white',function(){
    return 'CSRF white';
});
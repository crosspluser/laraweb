<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//匹配路由
Route::match(['post','get'],'foo', function (Request $request) {
    return 'MATCH[POST,GET] api-foo';
});

//重定向路由
Route::redirect('foo2', '/foo', 301);

Route::get('foo3', function(){
    return redirect()->route('foo-get');
});



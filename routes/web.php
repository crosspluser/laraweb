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

use Illuminate\Support\Facades\Log;

Route::get( '/', function(){
    return view( 'welcome' );
} );

//异常处理
//Report 方法
Route::get( 'report', function(){

} );

//HTTP 异常
Route::get( 'abort/404', function(){
    abort( 404, 'message' );//自定义 HTTP 错误页面
} );
Route::get( 'abort/403', function(){
    abort( 403, 'Unauthorized action.abc' );
} );

//自定义异常的 report & render 方法

//辅助函数 report
Route::get( 'try', function(){
    try{
        abort( 403, 'Unauthorized action.abc' );
    }catch( Exception $e ){
        report( $e );
        return 'try false';
    }
    return 'try true';
} );

//日志
Route::get( 'log', function(){
    $message = date( 'Y-m-d', time() );
    $return = [
        'emergency' => Log::emergency( $message ),
        'alert'     => Log::alert( $message ),
        'critical'  => Log::critical( $message ),
        'error'     => Log::error( $message ),
        'warning'   => Log::warning( $message ),
        'notice'    => Log::notice( $message ),
        'info'      => Log::info( $message ),
        'debug'     => Log::debug( $message ),
        'array'     => Log::info( 'array', [ 'key' => 'value' ] ),//上下文信息
    ];

    return $return;
} );
//访问底层的 Monolog 实例
Route::get( 'monolog', function(){
    $monolog = Log::getMonolog();
    dd( $monolog );
} );

/**
 * key
 */
//日志严重程度级别:大于等于这个级别,决定记录等级;APP_DEBUG决定记录与显示内容

/**
 * @todo
 */
//自定义 Monolog 配置:用到再研究
//自定义渠道名称:用到再研究
//自定义异常的 report & render 方法:render是一系列常见机制,等用到再研究
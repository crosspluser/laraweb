<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show( Request $request, $id ){
        //设置session
        //session(['key'=>'value']);//设置session
        $request->session()->put( 'null', null );//与全局函数等价//等价于session([''=>''])
        //$request->session()->push( 'push.push', 'push' );//键有点,而不是值;键会重复,会不断新增
        //$request->session()->forget('push');//删除数据
        //$request->session()->flush();//清空数据

        //$request->session()->regenerate();//重新生成一个session_id. 后台确定会新增,取消后不新增.但前台刷新好像没变,可能要传新session_id给前台

        $return = [
            'user'        => $request->session()->get( 'user', null ),
            'key'         => $request->session()->get( 'key', 'key' ),
            '_token'      => $request->session()->get( '_token', '_token' ),
            'has_token'   => $request->session()->has( 'null' ),//判断存在,null不存在
            'exist_token' => $request->session()->exists( 'null' ),//判断存在,null也存在
            'all'         => $request->session()->all(),
        ];

        //$request->session()->flash( 'user', User::find( $id ) );//刷新一遍等于一次http请求,会清空,所以一直是null
        $request->session()->reflash( 'user', User::find( $id ) );//在同一次http请求内可以无限使用,直到其他请求来到后刷新

        //获取session
        return response( $return );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ){
        //
    }
}

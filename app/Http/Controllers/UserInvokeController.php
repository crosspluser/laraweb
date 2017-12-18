<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserInvokeController extends Controller{
    //

    //单个行为控制器：如果找不到user，会导致路由也失败
    public function __invoke($id = 0){
        return [ 'user' => User::findOrFail( $id ) ?? null];//
    }
}

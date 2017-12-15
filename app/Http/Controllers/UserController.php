<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function name( $p1 = '' ){
        return [
            'p1' => $p1,
            'route_name' => route( 'name' ) ,
            'name' => \Route::currentRouteName() ,
            'action' => \Route::currentRouteAction() ,
            'route' => \Route::current() ,
        ];
    }
}

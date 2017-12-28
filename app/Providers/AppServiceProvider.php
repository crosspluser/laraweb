<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Rules\Uppercase;

class AppServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        //
        //使用扩展
        Validator::extend( 'foo', function( $attribute, $value, $parameters, $validator ){
            return $value == 'foo';
        } );
        Validator::extend( 'up', 'Uppercase@passes' );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        //
    }
}

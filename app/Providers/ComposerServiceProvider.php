<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\User;

class ComposerServiceProvider extends ServiceProvider{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot( User $users ){
        //使用基于类的composer
        View::composer( '*', 'App\Http\ViewComposers\ProfileComposer' );//'profile',[]等都可以

        //使用基于闭包的composer
/*        View::composer( 'profile', function( $view ) use ( $users ){
            //可以不用类,直接修改$view,但限于这里
            $view->with( 'count', $users->count() );
        } );*/

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(){
        //
    }
}

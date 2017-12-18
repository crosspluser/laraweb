<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Route;//引入门面后，类有了，静态调用也有了；引入之前，不能静态调用

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::resourceVerbs([
            //'create' => 'form',//本地化资源URI、自定义路由等
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

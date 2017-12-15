<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->age >=1000)  return redirect('/');

        return $next($request);

        //后置中间件
        //$response = $next($request);//构造响应
        // 执行动作
        //return $response;//返回响应，而不是继续请求，适合用来写状态码
    }
}

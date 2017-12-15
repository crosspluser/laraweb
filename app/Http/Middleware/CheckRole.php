<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        dd($role);

        return $next($request);
    }

    //有专门的中间件StartSession，不必每个配置
/*    public function terminate($request, $response, $role)
    {
        // Store the session data...
    }*/
}

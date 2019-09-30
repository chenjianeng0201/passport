<?php

namespace App\Http\Middleware;

use Closure;

class PassportGuard
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

        try {
            if ($request->is('admin/*')) {// 如果是 admin 路由
                config(['auth.guards.api.provider' => 'admins']);
            } elseif ($request->is('customer/*')) { // 如果是 customer 路由
                config(['auth.guards.api.provider' => 'customers']);
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis as Redis;

class AdminMiddleware
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
        $userId = Redis::get('MF_ADMIN_USER_ID' . session()->getId());

        if ( !$userId ) {
            return redirect('/mf/login?redirect_url=' . urlencode($request->url()));
        }

        return $next($request);
    }
}

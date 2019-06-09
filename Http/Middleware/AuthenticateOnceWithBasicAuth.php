<?php

namespace Modules\Portal\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        return auth($guard)->onceBasic() ?: $next($request);
    }
}

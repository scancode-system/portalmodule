<?php

namespace Modules\Portal\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class HasEventMiddleware
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
        $company = auth('company')->user();
        if($company->event){
            return $next($request);
        } else {
            return redirect()->route('portal.companies.edit', [$company->id, 0]);
        }
    }

}

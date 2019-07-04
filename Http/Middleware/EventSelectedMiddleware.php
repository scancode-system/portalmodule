<?php

namespace Modules\Portal\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EventSelectedMiddleware
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
       
        if(auth()->user()->event){
            return $next($request);
        } else {
            return redirect()->route('events.index')->with('info', 'Informação: para importar dados é necessário criar ou selecionar um evento.');
        }
    }
}

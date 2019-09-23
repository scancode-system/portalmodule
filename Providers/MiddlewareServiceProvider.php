<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Modules\Portal\Http\Middleware\EventSelectedMiddleware;
use Modules\Portal\Http\Middleware\AuthenticateOnceWithBasicAuth;

class MiddlewareServiceProvider extends ServiceProvider {

    //protected $defer = true;
 
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router) {
        $router->aliasMiddleware('event.selected', EventSelectedMiddleware::class);
        $router->aliasMiddleware('auth.basic.once', AuthenticateOnceWithBasicAuth::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {   
    }

}
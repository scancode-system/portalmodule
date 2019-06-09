<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Portal\Observers\ClientObserver;
use Modules\Portal\Entities\Client;

class ObserviceServiceProvider extends ServiceProvider {

    //protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Client::observe(ClientObserver::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}

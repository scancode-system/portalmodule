<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Portal\Entities\Company;
use Modules\Portal\Observers\CompanyObserver;
use Modules\Portal\Entities\Event;
use Modules\Portal\Observers\EventObserver;

class ObserviceServiceProvider extends ServiceProvider {

    //protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        Company::observe(CompanyObserver::class);
        Event::observe(EventObserver::class);
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

<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Portal\Entities\Client;
use Modules\Portal\Entities\Admin;

class GuardsServiceProvider extends ServiceProvider {

    //protected $defer = true;
 
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $guards = config('auth.guards');
        $guards['client'] = [
            'driver' => 'session',
            'provider' => 'clients',
        ];
        $guards['admin'] = [
            'driver' => 'session',
            'provider' => 'admins', 
        ];

        config(['auth.guards' => $guards]);



        $providers = config('auth.providers');
        $providers['clients'] =  [
            'driver' => 'eloquent',
            'model' => Client::class,
        ];
        $providers['admins'] = [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ];

        config(['auth.providers' => $providers]);


        $passwords = config('auth.passwords');
        $passwords['clients'] =  [
            'provider' => 'clients',
            'table' => 'clients_password_resets',
            'expire' => 60,
        ];
        $passwords['admins'] = [
            'provider' => 'admins',
            'table' => 'admins_password_resets',
            'expire' => 60,
        ];

        config(['auth.passwords' => $passwords]);        
    }

}
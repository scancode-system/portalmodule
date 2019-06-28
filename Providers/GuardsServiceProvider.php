<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Portal\Entities\Company;
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
        $guards['company'] = [
            'driver' => 'session',
            'provider' => 'companies',
        ];
        $guards['admin'] = [
            'driver' => 'session',
            'provider' => 'admins', 
        ];

        config(['auth.guards' => $guards]);



        $providers = config('auth.providers');
        $providers['companies'] =  [
            'driver' => 'eloquent',
            'model' => Company::class,
        ];
        $providers['admins'] = [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ];

        config(['auth.providers' => $providers]);


        $passwords = config('auth.passwords');
        $passwords['companies'] =  [
            'provider' => 'companies',
            'table' => 'companies_password_resets',
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
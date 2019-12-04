<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class BladeServiceProvider extends ServiceProvider {

	public function boot() {
		Blade::include('portal::includes.alert_success_include', 'alert_success');
		Blade::include('portal::includes.alert_errors_include', 'alert_errors');

	}

	public function register() {
        //
	}

}

<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class BladeServiceProvider extends ServiceProvider {

	public function boot() {
		Blade::directive('currency', function ($expression) {
			return "<?php echo 'R$' . number_format($expression, 2, ',', '.'); ?>";
		});
		Blade::include('portal::includes.alert_success_include', 'alert_success');
		Blade::include('portal::includes.alert_errors_include', 'alert_errors');
		Blade::include('portal::includes.loader', 'loader');
	}

	public function register() {
        //
	}

}

<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Modules\Portal\Rules\UniqueCustomValuesRule;
use Modules\Portal\Rules\NotPresentCustomValuesRule;
use Modules\Portal\Rules\BlockedRule;
use Modules\Portal\Rules\PresentWithRule;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_custom_values', function ($attribute, $value, $parameters, $validator) {
            return (new UniqueCustomValuesRule($parameters, $validator))->passes($attribute, $value);
        });

        Validator::extend('blocked', function ($attribute, $value, $parameters, $validator) {
            return (new BlockedRule($parameters, $validator))->passes($attribute, $value);
        });


        Validator::extend('present_with', function ($attribute, $value, $parameters, $validator) {
            return (new PresentWithRule($parameters, $validator))->passes($attribute, $value);
        });

        Validator::extend('not_present_custom_values', function ($attribute, $value, $parameters, $validator) {
            return (new NotPresentCustomValuesRule($parameters, $validator))->passes($attribute, $value);
        });
    }
}

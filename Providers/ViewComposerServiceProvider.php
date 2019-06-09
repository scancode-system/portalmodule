<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider {

    public function boot() {
        //auth
        View::composer(['portal::dashboard.index', 'portal::main.subview.import', 'portal::documentations.index', 'portal::videos.index'], 'App\Http\ViewComposers\Auth\ClientValidationsComposer');

        //parameters
        View::composer(['portal::import.index', 'portal::validation.index', 'portal::doc.*'], 'App\Http\ViewComposers\Parameters\ClientValidationComposer');

        //dashboard
        View::composer('portal::dashboard.subviews.item_client_validation', 'App\Http\ViewComposers\Dashboard\ItemClientValidationComposer');
        
        // main     
        View::composer('portal::main.index', 'App\Http\ViewComposers\Main\IndexComposer');
        View::composer('portal::main.subview.images', 'App\Http\ViewComposers\Main\ImagesComposer');
        View::composer('portal::main.subview.import.table_row', 'App\Http\ViewComposers\Main\Import\TableRowComposer');
        
        // validation        
        View::composer('portal::validation.subviews.loading', 'App\Http\ViewComposers\Validation\LoadingComposer');
    }

    public function register() {
        //
    }

}

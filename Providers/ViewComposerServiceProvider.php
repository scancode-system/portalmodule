<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider {

    public function boot() {
        //auth
        View::composer(['portal::dashboard.index', 'portal::main.subview.import', 'portal::documentations.index', 'portal::videos.index'], 'Modules\Portal\Http\ViewComposers\Auth\ClientValidationsComposer');

        //parameters
        View::composer(['portal::import.index', 'portal::validation.index', 'portal::doc.*'], 'Modules\Portal\Http\ViewComposers\Parameters\ClientValidationComposer');

        //dashboard
        View::composer('portal::dashboard.subviews.item_client_validation', 'Modules\Portal\Http\ViewComposers\Dashboard\ItemClientValidationComposer');
        
        // main     
        View::composer('portal::main.index', 'Modules\Portal\Http\ViewComposers\Main\IndexComposer');
        View::composer('portal::main.subview.images', 'Modules\Portal\Http\ViewComposers\Main\ImagesComposer');
        View::composer('portal::main.subview.import.table_row', 'Modules\Portal\Http\ViewComposers\Main\Import\TableRowComposer');
        
        // validation        
        View::composer('portal::validation.subviews.loading', 'Modules\Portal\Http\ViewComposers\Validation\LoadingComposer');
    }

    public function register() {
        //
    }

}

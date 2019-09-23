<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider {

    public function boot() {
        //auth
        View::composer(['portal::dashboard.index', 'portal::main.subview.import', 'portal::documentations.index', 'portal::videos.index'], 'Modules\Portal\Http\ViewComposers\Auth\EventValidationsComposer');

        //parameters
        View::composer(['portal::import.index', 'portal::validation.index'], 'Modules\Portal\Http\ViewComposers\Parameters\EventValidationComposer');

        //dashboard
        View::composer('portal::dashboard.subviews.item_event_validation', 'Modules\Portal\Http\ViewComposers\Dashboard\ItemEventValidationComposer');
        
        // main     
        View::composer('portal::main.index', 'Modules\Portal\Http\ViewComposers\Main\IndexComposer');
        View::composer('portal::main.subview.images', 'Modules\Portal\Http\ViewComposers\Main\ImagesComposer');
        View::composer('portal::main.subview.import.table_row', 'Modules\Portal\Http\ViewComposers\Main\Import\TableRowComposer');
        
        // validation        
        View::composer(['portal::validation.subviews.loading', 'portal::validation.subviews.loading2', 'portal::validation.subviews.validation_event'], 'Modules\Portal\Http\ViewComposers\Validation\LoadingComposer');

        //////////////////////////////////////////////////////
        // layouts
        View::composer('portal::layouts.app', 'Modules\Portal\Http\ViewComposers\Layouts\AppComposer');        
        // companies        
        View::composer('portal::companies.edit', 'Modules\Portal\Http\ViewComposers\Companies\EditComposer');
        // events
        View::composer('portal::events.index', 'Modules\Portal\Http\ViewComposers\Events\IndexComposer');
    }

    public function register() {
        //
    }

}

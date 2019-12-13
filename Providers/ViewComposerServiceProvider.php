<?php

namespace Modules\Portal\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider {

    public function boot() {
        //auth
        View::composer(['portal::dashboard.index', 'portal::imports.index'], 'Modules\Portal\Http\ViewComposers\Auth\EventValidationsComposer');

        //parameters
        View::composer(['portal::import.index', 'portal::validation.index'], 'Modules\Portal\Http\ViewComposers\Parameters\EventValidationComposer');

        //dashboard
        View::composer('portal::dashboard.subviews.item_event_validation', 'Modules\Portal\Http\ViewComposers\Dashboard\ItemEventValidationComposer');
        
        // main     
        View::composer('portal::main.index', 'Modules\Portal\Http\ViewComposers\Main\IndexComposer');
        View::composer(['portal::main.subview.images', 'portal::images.index'], 'Modules\Portal\Http\ViewComposers\Main\ImagesComposer');
        View::composer('portal::main.subview.import.table_row', 'Modules\Portal\Http\ViewComposers\Main\Import\TableRowComposer');
        
        // validation        
        View::composer(['portal::validation.subviews.loading', 'portal::validation.subviews.loading2', 'portal::validation.subviews.validation_event'], 'Modules\Portal\Http\ViewComposers\Validation\LoadingComposer');

        //////////////////////////////////////////////////////
        // layouts
        View::composer(['portal::layouts.app', 'portal::layouts.subviews.events'], 'Modules\Portal\Http\ViewComposers\Layouts\AppComposer');
        View::composer('portal::layouts.subviews.alerts', 'Modules\Portal\Http\ViewComposers\Layouts\Subviews\AlertsComposer');        

        // companies        
        View::composer('portal::companies.edit', 'Modules\Portal\Http\ViewComposers\Companies\EditComposer');

        // events
        View::composer('portal::events.index', 'Modules\Portal\Http\ViewComposers\Events\IndexComposer');

        // imports
        View::composer('portal::imports.widget.import', 'Modules\Portal\Http\ViewComposers\Imports\Widget\ImportComposer');

        // faqq
        View::composer('portal::faq.index', 'Modules\Portal\Http\ViewComposers\FAQ\IndexComposer');
        View::composer('portal::faq.items', 'Modules\Portal\Http\ViewComposers\FAQ\ItemComposer');  

         // system settings
        View::composer('portal::system_settings.index', 'Modules\Portal\Http\ViewComposers\SystemSetting\IndexComposer');

        // system settings
        View::composer('portal::settings.index', 'Modules\Portal\Http\ViewComposers\Settings\IndexComposer');
    }

    public function register() {
        //
    }

}

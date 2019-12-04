<?php

namespace Modules\Portal\Http\ViewComposers\Settings;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;


class IndexComposer extends SuperComposer {

    private $tab;
    private $event_settings;

    public function assign($view){
        $this->tab();
        $this->eventSettings();
    }


    private function tab(){
        $this->tab = request()->route('tab');
    }

    private function eventSettings(){
        $event = auth('company')->user()->event;
        $this->event_settings = $event->event_settings; 
    }


    public function view($view){
        $view->with('tab', $this->tab);
        $view->with('event_settings', $this->event_settings);
    }

}
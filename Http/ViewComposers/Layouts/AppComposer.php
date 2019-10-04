<?php

namespace Modules\Portal\Http\ViewComposers\Layouts;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class AppComposer extends SuperComposer {

    private $company;
    private $event;
    private $event_validations;
    private $events;
    private $id_event;

    public function view($view){
        $view->with('company', $this->events);
        $view->with('event', $this->event);
        $view->with('event_validations', $this->event_validations);
        $view->with('events', $this->events);
        $view->with('id_event', $this->id_event);
    }

    public function assign($view){
        $this->company();
        $this->event();
        $this->event_validations();
        $this->events();
        $this->id_event();
    }

    public function company(){
        $this->events_select = auth('company')->user();
    }

    public function event(){
        $this->event = auth('company')->user()->event;
    }

    public function event_validations(){
        if($this->event){
            $this->event_validations = $this->event->event_validations;
        }
    }

    public function events(){
        $this->events = ['Evento não selecionado'] + auth('company')->user()->events()->pluck('name', 'id')->toArray();
    }

    public function id_event(){
        $event = auth('company')->user()->events()->where('selected', true)->first();
        $this->id_event = ($event)?$event->id:null;
    }

}

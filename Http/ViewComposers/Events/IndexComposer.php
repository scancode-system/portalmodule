<?php
/* PODE DELETAR ESTE COMPOSER */
namespace Modules\Portal\Http\ViewComposers\Events;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class IndexComposer extends SuperComposer {

    private $events;

    public function view($view){
        $view->with('events', $this->events);
    }

    public function assign($view){
        $this->events();
    }

    public function events(){
        $this->events = auth()->user()->events;
    }

}

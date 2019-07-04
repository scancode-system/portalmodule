<?php

namespace Modules\Portal\Http\ViewComposers\Auth;

use Illuminate\View\View;

class EventValidationsComposer {

    private $event_validations;

    public function compose(View $view) {
        $this->bootstrap();
        $view->with('event_validations', $this->event_validations);
    }

    private function bootstrap(){
        $this->event_validations();
    }

    private function event_validations(){
        $this->event_validations = auth()->user()->event->event_validations()->with('validation')->get();
    }

}

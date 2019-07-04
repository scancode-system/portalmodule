<?php

namespace Modules\Portal\Http\ViewComposers\Parameters;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class EventValidationComposer extends SuperComposer {

	private $event_validation;

	public function view($view){
		$view->with('event_validation', $this->event_validation);
	}

	public function assign($view){
		$this->event_validation();
	}

	public function event_validation(){
		$this->event_validation = request()->route('event_validation');
	}

}

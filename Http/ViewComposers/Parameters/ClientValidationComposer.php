<?php

namespace Modules\Portal\Http\ViewComposers\Parameters;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class ClientValidationComposer extends SuperComposer {

	private $client_validation;

	public function view($view){
		$view->with('client_validation', $this->client_validation);
	}

	public function assign($view){
		$this->client_validation();
	}

	public function client_validation(){
		$this->client_validation = request()->route('client_validation');
	}

}

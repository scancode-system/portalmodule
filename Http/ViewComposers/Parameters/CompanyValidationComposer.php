<?php

namespace Modules\Portal\Http\ViewComposers\Parameters;

use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\View\View;

class CompanyValidationComposer extends SuperComposer {

	private $company_validation;

	public function view($view){
		$view->with('company_validation', $this->company_validation);
	}

	public function assign($view){
		$this->company_validation();
	}

	public function company_validation(){
		$this->company_validation = request()->route('company_validation');
	}

}

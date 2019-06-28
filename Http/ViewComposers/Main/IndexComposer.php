<?php

namespace Modules\Portal\Http\ViewComposers\Main;

use Illuminate\View\View;
use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;

class IndexComposer extends SuperComposer {

	private $tab;
	private $company;
	private $client_setting;

	public function view($view){
		$view->with('tab', $this->tab);
		$view->with('company', $this->company);
		$view->with('client_setting', $this->client_setting);
	}

	public function assign($view){
		$this->tab();
		$this->company();
		$this->client_setting();
	}

	private function tab(){
		$this->tab = request()->route('tab');
	}

	private function company(){
		$this->company = auth()->user()->company;
	}

	private function client_setting(){
		$this->client_setting = auth()->user()->client_setting;
	}

}

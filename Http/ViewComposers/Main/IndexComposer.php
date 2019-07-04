<?php

namespace Modules\Portal\Http\ViewComposers\Main;

use Illuminate\View\View;
use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;

class IndexComposer extends SuperComposer {

	private $tab;
	private $company_info;
	private $company_address;
	private $system_setting;

	public function view($view){
		$view->with('tab', $this->tab);
		$view->with('company_info', $this->company_info);
		$view->with('company_address', $this->company_address);
		$view->with('system_setting', $this->system_setting);
	}

	public function assign($view){
		$this->tab();
		$this->company_info();
		$this->company_address();
		$this->system_setting();
	}

	private function tab(){
		$this->tab = request()->route('tab');
	}

	private function company_info(){
		$this->company_info = auth()->user()->company_info;
	}

	private function company_address(){
		$this->company_address = auth()->user()->company_address;
	}

	private function system_setting(){
		$this->system_setting = auth()->user()->event->system_setting;
	}

}

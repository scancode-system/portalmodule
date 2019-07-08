<?php

namespace Modules\Portal\Services\Validation;

use Illuminate\Support\Facades\Session;

class ValidationInfoService {
	
	private $id;

	private $legend;
	private $porcent;
	private $validated;

	public function __construct($id){
		$this->id = $id;

		$this->legend = session('validation.'.$this->id.'.loaded', '');
		$this->porcent = session('validation.'.$this->id.'.porcent', 0);
		$this->validated = session('validation.'.$this->id.'.validated', false);
	}

	public function update(){
		$this->index++;
		$this->save();
	}

	private function save(){
		session(['validation.'.$this->id.'.loaded' => $this->porcent()]);
		Session::save();
	}

	private function porcent(){
		return round($this->index*100/$this->total);
	}

}

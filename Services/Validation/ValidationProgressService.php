<?php

namespace Modules\Portal\Services\Validation;

use Illuminate\Support\Facades\Session;

class ValidationProgressService {
	
	private $id;
	private $index;
	private $total;

	public function __construct($id, $total){
		$this->id = $id;
		$this->total = $total;
		$this->index = 0;
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

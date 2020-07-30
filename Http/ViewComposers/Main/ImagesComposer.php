<?php

namespace Modules\Portal\Http\ViewComposers\Main;

use Illuminate\View\View;
use Modules\Portal\Http\ViewComposers\SuperComposer\SuperComposer;
use Illuminate\Support\Facades\Storage;

class ImagesComposer extends SuperComposer {

	private $produtos;
	private $logo;

	public function view($view){
		$view->with('produtos', $this->produtos);
		$view->with('logo', $this->logo);
	}

	public function assign($view){
		$this->produtos();
		$this->logo();
	}

	private function produtos(){
		$produtos = Storage::disk('local')->files('companies/'.auth()->user()->id.'/images/produtos');
		foreach ($produtos as $key => $produto) {
			$produtos[$key] = str_replace('companies/'.auth()->user()->id.'/images/produtos/', '', $produto);
		}

		$this->produtos = $produtos;
	}

	private function logo(){
		$this->logo = Storage::disk('local')->exists('companies/'.auth()->user()->id.'/images/logo/logo.png');
	}

}

<?php

namespace Modules\Portal\Http\ViewComposers\SuperComposer;

use Modules\Portal\Http\ViewComposers\SuperComposer\InterfaceComposer;
use Illuminate\View\View;
use \stdClass;

abstract class SuperComposer  implements InterfaceComposer {

	protected $data;

	public function __construct(){
		$this->data = new stdClass;
	}

    public function compose(View $view) {
        $this->data($view);
        $this->assign($view);
        $this->view($view);
    }

    public function data($view){}

}

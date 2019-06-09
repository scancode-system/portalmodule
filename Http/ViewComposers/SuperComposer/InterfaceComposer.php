<?php

namespace Modules\Portal\Http\ViewComposers\SuperComposer;

interface InterfaceComposer {

	public function data($view);
	public function assign($view);
	public function view($view);

}

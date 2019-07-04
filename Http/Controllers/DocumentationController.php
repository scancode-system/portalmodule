<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Http\Controllers\BaseController;

class DocumentationController extends BaseController
{

		public function __construct()
	{
		parent::__construct();
		$this->middleware('event.selected');
	}

	public function index(){
		return view('portal::documentations.index');
	}

}

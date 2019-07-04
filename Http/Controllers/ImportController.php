<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Http\Controllers\BaseController;

class ImportController extends BaseController
{
	
	public function __construct()
	{
		parent::__construct();
		$this->middleware('event.selected');
	}
	
	public function index(Request $request, EventValidation $event_validation)
	{
		return view('portal::import.index');
	}
}

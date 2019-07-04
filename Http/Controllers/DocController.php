<?php

namespace Modules\Portal\Http\Controllers;

use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Entities\Validation;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Modules\Portal\Http\Controllers\BaseController;

class DocController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->middleware('event.selected');
	}
	
	public function index(Request $request, EventValidation $event_validation){
		return view($event_validation->validation->module_alias.'::documentation');
	}

	public function downloadSample(Request $request, EventValidation $event_validation){
		return response()->download(Module::assetPath($event_validation->validation->module_alias).'/'.$event_validation->validation->file);
	}

	public function downloadPDF(Request $request, Validation $validation){
		return response()->download(Module::assetPath($validation->module_alias).'/'.$validation->validation.'.pdf', $validation->alias.'.pdf');
	}

}

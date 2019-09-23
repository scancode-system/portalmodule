<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\RequestValidation;
use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Services\Validation\ValidationService;
use Modules\Portal\Services\Validation\ValidationFileSessionService;
use Modules\Portal\Http\Controllers\BaseController;


class ValidationController extends BaseController
{

		public function __construct()
	{
		parent::__construct();
		$this->middleware('event.selected');
	}

	public function index(RequestValidation $request, EventValidation $event_validation)
	{
		ValidationService::beforeStart($event_validation->id, $request->file);
		//return view('portal::validation.index');
	}

	public function start(Request $request, EventValidation $event_validation)
	{
		ValidationService::start($event_validation->id);
		return view('portal::validation.subviews.loading2');
	}

	public function info(Request $request, EventValidation $event_validation)
	{
		return view('portal::validation.subviews.loading2');
	}	

		public function start2(Request $request, EventValidation $event_validation)
	{
		ValidationService::start($event_validation->id);
		return view('portal::validation.subviews.validation_event', ['event_validation' => $event_validation->id]);
	}

	public function info2(Request $request, EventValidation $event_validation)
	{
		return view('portal::validation.subviews.validation_event', ['event_validation' => $event_validation->id]);
	}	

	public function download(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/validations/'.$event_validation->id.'.xlsx'), $event_validation->validation->alias.'.xlsx');
	}	

}

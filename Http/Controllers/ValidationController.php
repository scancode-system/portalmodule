<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\RequestValidation;
use Modules\Portal\Entities\CompanyValidation;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Services\Validation\ValidationService;
use Modules\Portal\Services\Validation\ValidationFileSessionService;
use Modules\Portal\Http\Controllers\BaseController;


class ValidationController extends BaseController
{

	public function index(RequestValidation $request, CompanyValidation $client_validation)
	{
		ValidationService::beforeStart($client_validation->id, $request->file);
		return view('portal::validation.index');
	}

	public function start(Request $request, CompanyValidation $client_validation)
	{
		ValidationService::start($client_validation->id);
		return view('portal::validation.subviews.loading');
	}

	public function info(Request $request, CompanyValidation $client_validation)
	{
		return view('portal::validation.subviews.loading');
	}	

	public function download(Request $request, CompanyValidation $client_validation)
	{
		return response()->download(storage_path('app/download/errors/'.$client_validation->id.'.xlsx'), $client_validation->validation->alias.'.xlsx');
	}	

}

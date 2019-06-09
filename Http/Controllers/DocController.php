<?php

namespace Modules\Portal\Http\Controllers;

use Modules\Portal\Entities\ClientValidation;
use Modules\Portal\Entities\Validation;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use App\Http\Controllers\Controller;

class DocController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:client');
	}
	
	public function index(Request $request, ClientValidation $client_validation){
		return view($client_validation->validation->module_alias.'::documentation');
	}

	public function downloadSample(Request $request, ClientValidation $client_validation){
		return response()->download(Module::assetPath($client_validation->validation->module_alias).'/'.$client_validation->validation->file);
	}

	public function downloadPDF(Request $request, Validation $validation){
		return response()->download(Module::assetPath($validation->module_alias).'/'.$validation->validation.'.pdf', $validation->alias.'.pdf');
	}

}

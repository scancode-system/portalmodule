<?php

namespace Modules\Portal\Http\Controllers;

use Modules\Portal\Entities\CompanyValidation;
use Modules\Portal\Entities\Validation;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;
use Modules\Portal\Http\Controllers\BaseController;

class DocController extends BaseController
{

	
	public function index(Request $request, CompanyValidation $company_validation){
		//return view('validationreseller::documentation');
		return view($company_validation->validation->module_alias.'::documentation');
	}

	public function downloadSample(Request $request, CompanyValidation $company_validation){
		return response()->download(Module::assetPath($company_validation->validation->module_alias).'/'.$company_validation->validation->file);
	}

	public function downloadPDF(Request $request, Validation $validation){
		return response()->download(Module::assetPath($validation->module_alias).'/'.$validation->validation.'.pdf', $validation->alias.'.pdf');
	}

}

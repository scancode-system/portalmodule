<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\CompanyValidation;
use Modules\Portal\Http\Controllers\BaseController;

class ImportController extends BaseController
{
	
	public function index(Request $request, CompanyValidation $company_validation)
	{
		return view('portal::import.index');
	}
}

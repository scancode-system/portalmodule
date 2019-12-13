<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;

class IntegrationController extends BaseController
{


	public function index(){
		return view('portal::integrations.index');
	}


}

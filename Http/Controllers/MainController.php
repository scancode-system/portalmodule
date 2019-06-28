<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;

class MainController extends BaseController
{
		
	public function index(Request $request, $tab) 
	{
		return view('portal::main.index');
	}

}

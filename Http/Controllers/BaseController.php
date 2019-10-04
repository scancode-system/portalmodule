<?php

namespace Modules\Portal\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller 
{

	public function __construct()
	{
		$this->middleware('auth:company');
		$this->middleware('has.event');
	}

}

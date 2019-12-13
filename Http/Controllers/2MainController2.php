<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;
use Modules\Portal\Services\Validation\ValidationService;

class MainController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index(Request $request, $tab) 
	{
		//session(['validation.7.in_progress' => false]);
		//dd(session('validation.7.in_progress2'));
//				session(['validation.'.$id.'.in_progress2' => false]);
		if($tab == 1){
			ValidationService::clear();
		}
		return view('portal::main.index');
	}

}

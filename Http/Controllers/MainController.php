<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;

class MainController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->middleware('event.selected');
	}

	public function index(Request $request, $tab) 
	{
		//session(['validation.7.in_progress' => false]);
		//dd(session('validation.7.in_progress2'));
		return view('portal::main.index');
	}

}

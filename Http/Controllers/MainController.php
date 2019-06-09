<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth:client');
	}
	
	public function index(Request $request, $tab) 
	{
		return view('portal::main.index');
	}

}

<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;

class DashboardController extends BaseController 
{

	public function __construct()
	{
		parent::__construct();
	}	

	public function index() 
	{
		//return redirect()->route('portal.companies.edit',[ auth('company')->user() ,0]);
		//CompanyController@edit
		return view('portal::dashboard.index');
	}

}

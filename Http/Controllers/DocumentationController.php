<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\Validation;
use App\Http\Controllers\Controller;


class DocumentationController extends Controller
{
    
	public function __construct()
	{
		$this->middleware('auth:client');
	}
    

	public function index(){
		return view('portal::documentations.index');
	}

}

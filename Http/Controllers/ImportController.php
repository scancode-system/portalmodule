<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\ClientValidation;
use App\Http\Controllers\Controller;

class ImportController extends Controller
{
	
	public function __construct()
	{
		$this->middleware('auth:client');
	}

	public function index(Request $request, ClientValidation $client_validation)
	{
		return view('portal::import.index');
	}
}

<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:client');
	}
    

	public function index(){
		return view('portal::videos.index');
	}

}

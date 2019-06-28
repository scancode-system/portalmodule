<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Controllers\BaseController;

class VideoController extends BaseController
{


	public function index(){
		return view('portal::videos.index');
	}

}

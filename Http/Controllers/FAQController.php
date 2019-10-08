<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Entities\FaqTopic;


class FAQController extends BaseController
{

	public function index(Request $request)
	{
		return view('portal::faq.index');
	}


	public function items(Request $request, FaqTopic $faq_topic){
		return view('portal::faq.items');
	}

}

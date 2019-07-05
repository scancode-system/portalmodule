<?php

namespace Modules\Portal\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Portal\Entities\Event;
use \ZipArchive;

class TokenController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth.basic.once:company');
	}


	public function event(Request $request, Event $event){
		$event->load('system_setting', 'event_validations', 'company', 'company.company_info', 'company.company_address');
		return $event->toJson();
	}


	public function files(Request $request, Event $event){
		$files = Storage::allFiles('companies/'.$event->company_id.'/'.$event->id);
		//dd($files);
		if(count($files)){
			$zip_path = storage_path('app/companies/'.$event->company_id.'/'.$event->id.'.zip'); 

			$zip = new ZipArchive;
			$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach ($files as $file) {
				$file = str_replace('companies/'.$event->company_id.'/'.$event->id.'/', '', $file);
				$zip->addFile(storage_path('/app/companies/'.$event->company_id.'/'.$event->id.'/'.$file), $file);
			}

			$zip->close();
			return response()->download($zip_path)->deleteFileAfterSend(true);
		} else {
			return response()->json([], 204);
		}

	}

}

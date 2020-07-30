<?php

namespace Modules\Portal\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;  
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
		dd('fd');
		$this->moveImageFiles($event);

		$files = Storage::allFiles('companies/'.$event->company_id.'/'.$event->id.'/clean');
		if(count($files)){
			$zip_path = storage_path('app/companies/'.$event->company_id.'/'.$event->id.'/clean'.'.zip'); 

			$zip = new ZipArchive;
			$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach ($files as $file) {
				$file = str_replace('companies/'.$event->company_id.'/'.$event->id.'/clean'.'/', '', $file);
				$zip->addFile(storage_path('/app/companies/'.$event->company_id.'/'.$event->id.'/clean'.'/'.$file), $file);
			}

			$zip->close();
			return response()->download($zip_path)->deleteFileAfterSend(true);
		} else {
			return response()->json([], 204);
		}
	}

	private function moveImageFiles(Event $event)
	{
		File::copyDirectory(storage_path('app/companies/'.$event->company->id.'/images'), storage_path('app/companies/'.$event->company->id.'/'.$event->id.'/clean/images'));
	}

	public function welcome(Request $request){
		return 'sucesso';
	}

}

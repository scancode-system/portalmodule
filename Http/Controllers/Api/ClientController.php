<?php

namespace Module\Portal\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \ZipArchive;

class ClientController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth.basic.once:client');
	}


	public function data(Request $request){
		$client = auth('client')->user();
		$client->load('company', 'client_validations', 'client_validations.validation', 'client_setting');
		return $client->toJson();
	}


	public function download(Request $request){

		$client = auth('client')->user();

		$files = Storage::files('clients/'.$client->id);
		if(count($files)){
			$zip_path = storage_path('app/clients/'.$client->id.'.zip'); 

			$zip = new ZipArchive;
			$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach ($files as $file) {
				$file = str_replace('clients/'.$client->id.'/', '', $file);
				$zip->addFile(storage_path('/app/clients/'.$client->id.'/'.$file), $file);
			}

			$zip->close();

			return response()->download($zip_path)->deleteFileAfterSend(true);
		} else {
			return response()->json([], 204);
		}

	}

}

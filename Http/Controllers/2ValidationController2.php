<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\RequestValidation;
use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Entities\Validation;
use Modules\Portal\Services\Validation\ValidationService;
use Modules\Portal\Services\Validation\ValidationFileSessionService;
use Modules\Portal\Http\Controllers\BaseController;
use \Exception;


class ValidationController extends BaseController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index(RequestValidation $request, EventValidation $event_validation)
	{
		ValidationService::beforeStart($event_validation->id, $request->file);
		return view('portal::validation.index');
	}

	public function index2(RequestValidation $request, EventValidation $event_validation)
	{
		$path = $request->file->store('uploads');

		try {
			$headings = ValidationService::missHeadings($event_validation->id, $path);
		} catch (Exception $e) {
			return  response()->json(['errors' => ['file' => 'Este arquivo não pode ser lido. Tente salvar o arquivo em formato EXCEL 2007 - 2019']], 422);
		}		


		if(count($headings) == 0){
			ValidationService::beforeStart($event_validation->id, $path);
			return  response()->json($headings, 200);
		} else {
			$headings2 = [];
			foreach ($headings as $i => $heading) {
				$headings2["#".$i] = $heading;
			}
			return  response()->json(['errors' => $headings2], 422);
		}

	}

	public function start(Request $request, EventValidation $event_validation)
	{
		ValidationService::start($event_validation->id);
		return view('portal::validation.subviews.loading2');
	}

	public function info(Request $request, EventValidation $event_validation)
	{
		return view('portal::validation.subviews.loading2');
	}	

	public function start2(Request $request, EventValidation $event_validation)
	{
		ValidationService::start($event_validation->id);
		return view('portal::validation.subviews.validation_event', ['event_validation' => $event_validation->id]);
	}

	public function info2(Request $request, EventValidation $event_validation)
	{
		return view('portal::validation.subviews.validation_event', ['event_validation' => $event_validation->id]);
	}	

	public function eventValidationClean(Request $request, EventValidation $event_validation){
		$event_validation->update(['failures' => 0, 'duplicates' => 0, 'modified' => 0, 'validated' => 0, 'original_file' => null, 'debug_file' => null, 'clean_file' => null, 'report' => null]);
		return back();
	}

	public function download(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/validations/'.$event_validation->id.'.xlsx'), $event_validation->validation->alias.'.xlsx');
	}	

	public function downloadOriginal(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/'.$event_validation->original_file), $event_validation->validation->alias.'_original.xlsx');
	}

	public function downloadDebug(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/'.$event_validation->debug_file), $event_validation->validation->alias.'_debug.xlsx');
	}

	public function downloadClean(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/'.$event_validation->clean_file), $event_validation->validation->alias.'_clean.xlsx');
	}

	public function errors(Request $request, EventValidation $event_validation){
		//dd($request->all());
		return view('portal::validation.subviews.errors', ['errors' => $request->all()]);
	}


}

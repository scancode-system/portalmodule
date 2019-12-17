<?php

namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Portal\Http\Requests\RequestValidation;
use Modules\Portal\Entities\EventValidation;
use Modules\Portal\Services\Validation\ValidationService;
use Modules\Portal\Services\Sample\SampleService;


class ImportsController extends BaseController 
{


	public function index(Request $request)
	{
		ValidationService::clear();
		return view('portal::imports.index');
	}


	public function upload(RequestValidation $request, EventValidation $event_validation)
	{
		$path = $request->file->store('uploads');
		try {
			$headings = ValidationService::missHeadings($event_validation, $path);

		} catch (Exception $e) {
			return  response()->json(['errors' => ['file' => 'Este arquivo não pode ser lido. Tente salvar o arquivo em formato EXCEL 2007 - 2019']], 422);
		}		
		if(count($headings) > 0){
			$headings2 = [];
			foreach ($headings as $i => $heading) {
				$headings2["#".$i] = $heading;
			}
			return  response()->json(['errors' => $headings2], 422);

		} else {
			ValidationService::beforeStart($event_validation->id, $path);
			return  response()->json($headings, 200);
		}
	}


	public function errors(Request $request, EventValidation $event_validation){
		return view('portal::imports.widget.subviews.errors', ['errors' => $request->all()]);
	}


	public function start(Request $request, EventValidation $event_validation)
	{
		ValidationService::start($event_validation->id);
		return view('portal::imports.widget.import', ['event_validation' => $event_validation->id]);
	}


	public function info(Request $request, EventValidation $event_validation)
	{
		return view('portal::imports.widget.import', ['event_validation' => $event_validation->id]);
	}	


	public function clean(Request $request, EventValidation $event_validation){
		$event_validation->update(['failures' => 0, 'duplicates' => 0, 'modified' => 0, 'validated' => 0, 'original_file' => null, 'debug_file' => null, 'clean_file' => null, 'report' => null]);
		return back();
	}

	public function downloadDemo(Request $request, EventValidation $event_validation)
	{
		$sample_service = new SampleService($event_validation);
		return $sample_service->download();
	}


	public function downloadOriginal(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/'.$event_validation->original_file), $event_validation->validation->alias.'_original.xlsx');
	}


	public function downloadDebug(Request $request, EventValidation $event_validation)
	{
		return response()->download(storage_path('app/'.$event_validation->debug_file), $event_validation->validation->alias.'_debug.xlsx');
	}


}

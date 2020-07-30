<?php

namespace Modules\Portal\Services\Validation;

use Modules\Portal\Exports\ValidationExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Excel;
use Modules\Portal\Entities\EventValidation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use Modules\Portal\Imports\ValidatorImport;
use Modules\Portal\Services\Validation\Data\InfoValidationsService;



class ValidationService {
	
	public static function clear(){
		$event_validations = auth()->user()->event->event_validations;
		foreach ($event_validations as $event_validation) {
			session(['validation.'.$event_validation->id.'.in_progress2' => false]);
		}
	}

	public static function beforeStart($id, $path)
	{
		session(['validation.'.$id.'.path' => $path]);
		session(['validation.'.$id.'.loaded' => 0]);
		session(['validation.'.$id.'.headings' => true]);		// talvez testar
		session(['validation.'.$id.'.missing_headings' => []]);	// testar pode testar sem

		session(['validation.'.$id.'.validated' => 0]);
		session(['validation.'.$id.'.modified' => 0]);
		session(['validation.'.$id.'.duplicates' => 0]);
		session(['validation.'.$id.'.failures' => 0]);

		session(['validation.'.$id.'.in_progress2' => true]);
	}

	public static function start($id)
	{
		$start = Carbon::createFromFormat('Y-m-d H:i', Carbon::now()->format('Y-m-d H:i'));
		$event_validation = EventValidation::find($id);
		$event_validation->update(['start' => $start]);

		$path = session('validation.'.$id.'.path');
		
		$event = $event_validation->event;
		$company = $event->company;

		$path_original_file = 'companies/'.$company->id.'/'.$event->id.'/original/'.$event_validation->validation->file;
		$path_debug_file = 'companies/'.$company->id.'/'.$event->id.'/debug/'.$event_validation->validation->file;
		$path_clean_file = 'companies/'.$company->id.'/'.$event->id.'/clean/'.$event_validation->validation->file;
		
		$info_validations = new InfoValidationsService($event_validation);
		$import = new ValidatorImport($event_validation, $info_validations);
		$import->import($path, 'local', Excel::XLSX); 

		session(['validation.'.$id.'.legend' => 'Novo arquivo sendo gerado']); 
		$export = self::export($import, $event_validation, $info_validations);
		$exportClean = self::exportClean($import, $event_validation, $info_validations);

		$event_validation = EventValidation::find($id);
		if($event_validation->start->eq($start)){
			$report = self::report($import, $path);

			if(Storage::exists('companies/'.$company->id.'/'.$event->id.'/original/'.$event_validation->validation->file)){
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/original/'.$event_validation->validation->file);
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/debug/'.$event_validation->validation->file);
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/clean/'.$event_validation->validation->file);
			}
			Storage::move($path, $path_original_file);
			$export->store($path_debug_file, 'local');
			$exportClean->store($path_clean_file, 'local');


			$validated = session('validation.'.$id.'.validated');
			$modified = session('validation.'.$id.'.modified');
			$duplicates = session('validation.'.$id.'.duplicates');
			$failures = session('validation.'.$id.'.failures');

			$event_validation->update(['failures' => $failures, 'duplicates' => $duplicates, 'modified' => $modified, 'validated' => $validated, 'original_file' => $path_original_file, 'debug_file' => $path_debug_file, 'clean_file' => $path_clean_file, 'report' => $report, 'status_id' => 2, 'update' => Carbon::now()]);
		}
		

		session(['validation.'.$id.'.in_progress2' => false]);
	}


	/*private static function import($event_validation){
		$class = 'Modules\\'.$event_validation->validation->module_name.'\Validator\\'.str_replace('_', '', ucwords($event_validation->validation->validation, '_')).'Validator';
		return new $class($event_validation->id);
	}*/

	private static function export($import, $event_validation, $info_validations){
		$cells = $import->cells();
		$fails = $import->fails();
		$changes = $import->changes();

		return new ValidationExport($cells, $changes, $fails, $info_validations); //self::instanceValidationExportClass($cells, $changes, $fails, $event_validation);
		//return new ValidationExport($cells, $changes, $fails);
	}

	private static function exportClean($import, $event_validation, $info_validations){
		$rows = $import->validatedRows();
		return new ValidationExport($rows, [], [], $info_validations); //self::instanceValidationExportClass($rows, [], [], $event_validation);
		//return new ValidationExport($rows, [], []);
	}

	private static function instanceValidationExportClass($cells, $changes, $fails, $event_validation){
		$class = 'Modules\\'.$event_validation->validation->module_name.'\Exports\ValidationExport'.str_replace('_', '', ucwords($event_validation->validation->validation, '_'));
		return new $class($cells, $changes, $fails);
	}

	private static function report($import, $path){
		$fails = $import->fails();
		$headings = $import->getHeadings($path);

		//dd($fails);
		$report = 
		'==========================================='."\r\n".
		'FALHAS'."\r\n".
		'==========================================='."\r\n";

		foreach ($fails as $failed) {
			$report.= 'LINHA: '.$failed[0].'		COLUNA: '.$headings[$failed[1]].'					'.$failed[2]."\r\n";
		}

		$report .= 
		"\r\n".
		"\r\n".
		'==========================================='."\r\n".
		'MODIFICADOS'."\r\n".
		'==========================================='."\r\n";

		return $report;
	}

	public static function missHeadings(EventValidation $event_validation, $path){
		$service_module = self::serviceModule($event_validation->validation->module_name);
		$fields = collect($service_module->fields());

		$event_validation_appends = $event_validation->event_validaton_appends;
		foreach ($event_validation_appends as $event_validaton_append) {
			$append = $event_validaton_append->appendModel;
			$append_service = self::serviceModule($append->module);
			$fields = $fields->merge($append_service->fields());

		}

		$file_headings = (new ValidatorImport($event_validation))->getHeadings($path);
		$missing_headings = collect([]);
		foreach ($fields as $field) {
			if (!in_array($field, $file_headings, true)) {
				$missing_headings->push($field);
			}
		}

		return $missing_headings;
	} 

	public static function serviceModule($module){
		$class = 'Modules\\'.$module.'\Services\\'.$module.'Service';
		return new $class();
	}


}

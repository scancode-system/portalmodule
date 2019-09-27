<?php

namespace Modules\Portal\Services\Validation;

use Modules\Portal\Exports\ValidationExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Excel;
use Modules\Portal\Entities\EventValidation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class ValidationService {
	
	public static function beforeStart($id, $path)
	{
		session(['validation.'.$id.'.path' => $path]);
		session(['validation.'.$id.'.loaded' => 0]);
		session(['validation.'.$id.'.result' => false]);
		session(['validation.'.$id.'.export' => false]);
		session(['validation.'.$id.'.headings' => true]);
		session(['validation.'.$id.'.missing_headings' => []]);
		session(['validation.'.$id.'.in_progress2' => true]);

		session(['validation.'.$id.'.validated' => 0]);
		session(['validation.'.$id.'.modified' => 0]);
		session(['validation.'.$id.'.duplicates' => 0]);
		session(['validation.'.$id.'.failures' => 0]);
	}

	public static function start($id)
	{
		$company_validation = EventValidation::find($id);
		$path = session('validation.'.$id.'.path');
		$import = self::import($company_validation);

		if($import->checkHeadings($path)){
			$event = $company_validation->event;
			$company = $event->company;

			$path_original_file = 'companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file;
			$path_debug_file = 'validations/'.$id.'.xlsx';
			$path_clean_file = 'validations/clean/'.$id.'.xlsx';			

			$import->import($path, 'local', Excel::XLSX); 
			session(['validation.'.$id.'.legend' => 'Novo arquivo sendo gerado']); 
			
			$export = self::export($import);
			$export->store($path_debug_file, 'local');

			$exportClean = self::exportClean($import);
			$exportClean->store($path_clean_file, 'local');

			$report = self::report($import, $path);


			if(Storage::exists('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file)){
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file);
			}
			Storage::move($path, $path_original_file);


			$validated = session('validation.'.$id.'.validated');
			$modified = session('validation.'.$id.'.modified');
			$duplicates = session('validation.'.$id.'.duplicates');
			$failures = session('validation.'.$id.'.failures');

			//dd('antes');
			$company_validation->update(['failures' => $failures, 'duplicates' => $duplicates, 'modified' => $modified, 'validated' => $validated, 'original_file' => $path_original_file, 'debug_file' => $path_debug_file, 'clean_file' => $path_clean_file, 'report' => $report, 'file' => $path, 'status_id' => 2, 'update' => Carbon::now()]);
			//dd('depois');

			session(['validation.'.$id.'.result' => $import->validated()]); 
			session(['validation.'.$id.'.export' => true]);	


		} else {
			session(['validation.'.$id.'.missing_headings' => $import->missing_headings($path)]);
			session(['validation.'.$id.'.headings' => false]);
		}

		/*if($ipmort->isValid()){
			$event = $company_validation->event;
			$company = $event->company;
			if(Storage::exists('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file)){
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file);
			}
			Storage::move($path, 'companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file);
			$company_validation->update(['file' => $path, 'status_id' => 2, 'update' => Carbon::now()]);
		} else {
			$export = self::export($import);
			$export->store('download/errors/'.$id.'.xlsx', 'local'); 

			session(['validation.'.$id.'.export' => true]); 
		}*/
		session(['validation.'.$id.'.in_progress2' => false]);
	}


	private static function import($company_validation){
		$class = 'Modules\\'.$company_validation->validation->module_name.'\Validator\\'.str_replace('_', '', ucwords($company_validation->validation->validation, '_')).'Validator';
		return new $class($company_validation->id);
	}

	private static function export($import){
		$cells = $import->cells();
		$fails = $import->fails();
		$changes = $import->changes();

		return new ValidationExport($cells, $changes, $fails);
	}

	private static function exportClean($import){
		$rows = $import->validatedRows();
		return new ValidationExport($rows, [], []);
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

	public static function missHeadings($id, $path){
		$company_validation = EventValidation::find($id);
		$import = self::import($company_validation);
		return $import->missing_headings($path);
	}



}

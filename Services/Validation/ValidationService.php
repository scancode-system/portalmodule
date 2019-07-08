<?php

namespace Modules\Portal\Services\Validation;

use Modules\Portal\Exports\ValidationExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Excel;
use Modules\Portal\Entities\EventValidation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class ValidationService {
	
	public static function beforeStart($id, $file)
	{
		$path = $file->store('uploads');
		session(['validation.'.$id.'.path' => $path]);
		session(['validation.'.$id.'.loaded' => 0]);
		session(['validation.'.$id.'.result' => false]);
		session(['validation.'.$id.'.export' => false]);
	}

	public static function start($id)
	{
		$company_validation = EventValidation::find($id);
		$path = session('validation.'.$id.'.path');

		$import = self::import($company_validation);
		$import->import($path, 'local', Excel::XLSX); 
		
		//session(['validation.'.$id.'.result' => $import->validated]); 
		session(['validation.'.$id.'.legend' => 'Novo arquivo sendo gerado']); 
		
		$export = self::export($import);
		$export->store('validations/'.$id.'.xlsx', 'local');

		if($import->validated()){
			$event = $company_validation->event;
			$company = $event->company;
			if(Storage::exists('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file)){
				Storage::delete('companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file);
			}
			Storage::move($path, 'companies/'.$company->id.'/'.$event->id.'/'.$company_validation->validation->file);
			$company_validation->update(['file' => $path, 'status_id' => 2, 'update' => Carbon::now()]);
		}

		session(['validation.'.$id.'.result' => $import->validated()]); 
		session(['validation.'.$id.'.export' => true]);	



		/*if($import->isValid()){
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


	}

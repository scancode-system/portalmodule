<?php

namespace Modules\Portal\Services\Validation;

use Modules\Portal\Exports\FailsExport;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Excel;
use Modules\Portal\Entities\CompanyValidation;
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
		$client_validation = CompanyValidation::find($id);
		$path = session('validation.'.$id.'.path');

		$import = self::import($client_validation);
		$import->import($path, 'local', Excel::XLSX); 

		session(['validation.'.$id.'.result' => (count($import->fails()) == 0)]); 
		
		if($import->isValid()){
			if(Storage::exists('clients/'.$client_validation->client_id.'/'.$client_validation->validation->file)){
				Storage::delete('clients/'.$client_validation->client_id.'/'.$client_validation->validation->file);
			}
			Storage::move($path, 'clients/'.$client_validation->client_id.'/'.$client_validation->validation->file);
			$client_validation->update(['file' => $path, 'status_id' => 2, 'update' => Carbon::now()]);
		} else {
			$export = self::export($import);
			$export->store('download/errors/'.$id.'.xlsx', 'local'); 

			session(['validation.'.$id.'.export' => true]); 
		}
	}


    private static function import($client_validation){
    	$class = 'Modules\\'.$client_validation->validation->module_name.'\Validator\\'.str_replace('_', '', ucwords($client_validation->validation->validation, '_')).'Validator';
    	return new $class($client_validation->id);
    }

    private static function export($import){
			$cells = $import->cells();
			$fails = $import->fails();

			return new FailsExport($cells, $fails);
		}


	}

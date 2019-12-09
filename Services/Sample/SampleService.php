<?php

namespace Modules\Portal\Services\Sample;

//use Maatwebsite\Excel\Excel;
use Modules\Portal\Exports\SampleExport;
use Modules\Portal\Entities\EventValidation;
use Maatwebsite\Excel\Facades\Excel;

class SampleService {
	
	private $event_validation;

	public function __construct(EventValidation $event_validation) 
	{
		$this->event_validation = $event_validation;
	}

	public function download()
	{
		return (new SampleExport($this->data(), $this->filledCells()))->download($this->fileName());
	}

	private function data(){
		$fields = $this->getSamples();
		$cells = [];

		foreach ($fields as $i => $field) {
			$cells[0][$i] = $field['name'];
			$cells[1][$i] = $field['observation']; 
		}

		return 	collect($cells);
	}

	private function filledCells(){
		$fields = $this->getSamples();
		$cells = collect([]);

		foreach ($fields as $i => $field) {
			if($field['filled'])
			{
				$cells->push([0, $i]);
			}
		}

		return $cells;
	}

	private function fileName(){
		return $this->event_validation->validation->alias.'.xlsx';
	}

	private function  getSamples(){
		$samples = collect([]);
		$services = $this->servicesAll();

		foreach ($services as $service) {
			$samples = $samples->merge($service->sample());
		}

		return $samples;
	}


	private function servicesAll(){
		$services = collect([]);
		$services->push($this->serviceModule($this->event_validation->validation->module_name));
		foreach ($this->event_validation->event_validaton_appends as $event_validaton_append) {
			$services->push($this->serviceModule($event_validaton_append->appendModel->module));
		}
		return $services;
	}

	private function serviceModule($module){
		$class = 'Modules\\'.$module.'\Services\\'.$module.'Service';
		return new $class();
	}

}

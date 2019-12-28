<?php

namespace Modules\Portal\Imports;

use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Facades\Validator;
use Modules\Portal\Services\Validation\ValidationProgressService;
use Modules\Portal\Imports\ValidatorInterface;
use Modules\Portal\Entities\EventValidation;
use Illuminate\Support\Str;


abstract class ValidatorImport implements OnEachRow, WithHeadingRow, WithEvents, ValidatorInterface
{

	use Importable, RegistersEventListeners;
	
	private $id;
	protected $progress;
	protected $fails;
	protected $changes;
	protected $header_not_present;
	protected $cells;
	protected $columns;
	protected $validated;
	protected $row;
	protected $row_index;

	protected $required;

	protected $validated_rows;
	private $event_validation;


	public function __construct($id){
		$this->id = $id;
		$this->validated = true;
		$this->event_validation = EventValidation::find($id);
	}


	public function onRow(Row $rowExcel)
	{

		$this->row = $rowExcel->toArray();
		$this->row_index = $rowExcel->getRowIndex();

		$this->preValidation();
		$this->trim();
		$this->filter();

		$this->validation();
		$this->progress->update();
	}

	private function preValidation(){
		$this->filters();
	}

	protected function filters(){}

	protected function phoneFilter($fields){
		$header = array_keys($this->row);
		foreach ($fields as $field) {
			$x = ($this->row_index-1);
			$y = array_search($field, $header);

			if(isset($this->row[$field])){
				$old_value = $this->row[$field];
				$new_value = substr(preg_replace('/[^-()0-9]/', '', $this->row[$field]), 0, 14);

				$this->row[$field] = $new_value;
				$this->cells[$x][$y] = $new_value;

				if($old_value != $new_value){
					array_push($this->changes, [($x+1), $y]);
					session(['validation.'.$this->id.'.modified' => (1+session('validation.'.$this->id.'.modified')) ]);
				}
			}
		}
	}

	protected function lengthFilter($fields, $length){
		$header = array_keys($this->row);
		foreach ($fields as $field) {
			$x = ($this->row_index-1);
			$y = array_search($field, $header);

			if(isset($this->row[$field])){
				$old_value = $this->row[$field];
				$new_value = substr($this->row[$field], 0, $length);

				$this->row[$field] = $new_value;
				$this->cells[$x][$y] = $new_value;

				if($old_value != $new_value){
					array_push($this->changes, [($x+1), $y]);
					session(['validation.'.$this->id.'.modified' => (1+session('validation.'.$this->id.'.modified')) ]);
				}
			}
		}
	}

	private function validation(){
		$validator = Validator::make($this->row, $this->rule($this->row), $this->messages());
		$validator->addCustomValues($this->columns);

		if ($validator->fails()) {
			//dd($validator->failed());
			//dd($this->row_index);
			//if($this->row_index == 69)
			//dd($validator->messages()->all());
			//dd($validator->failed());

			$this->validated = false;
			$fields = array_keys($validator->failed());
			foreach ($fields as $field) {
				//if($this->row_index == 69)
				//dd($validator->messages()->get($field));
				//dd($validator->failed());
				//dd($validator->messages()->all());

				$coordinate = $this->coordinateCellFailed($this->row, $this->row_index, $validator, $field);
				array_push($this->fails, [$coordinate[0], $coordinate[1], $validator->messages()->get($field)[0] ]);
			}
			//session(['validation.'.$this->id.'.failures' => $validated]);
			session(['validation.'.$this->id.'.failures' => (1+session('validation.'.$this->id.'.failures')) ]);
			$this->checkDuplicates($validator);
		} else {
			//$validated = ++session('validation.'.$this->id.'.validated');
			//$validated++;
			session(['validation.'.$this->id.'.validated' => (1+session('validation.'.$this->id.'.validated')) ]);
			array_push($this->validated_rows, $this->row);
		}
	}

	/********* Call Appends Data *********/
	public function rule($data){
		$rules =  collect([]);
		foreach ($this->appendValidationsAll() as $append_validation) {
			$rules = $rules->merge($append_validation->rule($data));
		}
		return $rules->toArray();
	}

	public function filterRules(){
		$filter_rules =  collect([]);
		foreach ($this->appendValidationsAll() as $append_validation) {
			$filter_rules = $filter_rules->merge($append_validation->filterRules($this->row));
		}
		return $filter_rules->toArray();
	}

	private function appendValidationsAll(){
		$append_validations = collect([]);
		foreach ($this->event_validation->event_validaton_appends as $event_validaton_append) {
			$append_validations->push($this->appendValidationClass($event_validaton_append->appendModel->module));
		}
		return $append_validations;
	}

	private function appendValidationClass($module){
		$class = 'Modules\\'.$module.'\Validator\\'.$module.'Validator';
		return new $class();
	}

	/******* End Appends Data ***********/




	private function checkDuplicates($validator){
		$messages = $validator->messages()->all();
		foreach ($messages as $message) {
			if($message == 'Duplicado'){
				session(['validation.'.$this->id.'.duplicates' => (1+session('validation.'.$this->id.'.duplicates')) ]);
			}
		}
		//if($this->row_index == 69)
		//	dd($validator->failed());
		/*foreach ($validator->failed() as $rules_failed) {
			if(array_key_exists('UniqueCustomValues', $rules_failed)){
				session(['validation.'.$this->id.'.duplicates' => (1+session('validation.'.$this->id.'.duplicates')) ]);
			}
		}*/
	}

	private function trim(){
		$header = array_keys($this->row);
		foreach ($header as $field) {
			$x = ($this->row_index-1);
			$y = array_search($field, $header);

			$this->row[$field] = trim($this->row[$field]);
			$this->cells[$x][$y] = $this->row[$field];

		}
	}



	private function filter(){
		$header = array_keys($this->row);
		$filterRules = $this->filterRules();
		foreach ($filterRules as $filterRule) {
			$rule = $filterRule['rule'];
			$field = key($filterRule['rule']);
			$filter = $filterRule['filter'];

			if(isset($this->row[$field])){

				$validator = Validator::make($this->row, $rule);
				if (!$validator->fails()) {
					$x = ($this->row_index-1);
					$y = array_search($field, $header);
					if($y || $y == 0){
						$old_value = $this->row[$field];
						$new_value = $this->$filter($this->row[$field]);
						$this->cells[$x][$y] = $new_value;
						$this->row[$field] = $new_value;
						if($new_value != $old_value){
							array_push($this->changes, [($x+1), $y]);
							session(['validation.'.$this->id.'.modified' => (1+session('validation.'.$this->id.'.modified')) ]);
						}
					}
				}
			}
		}
	}

	private function setToOne($value){
		return 1;
	}

	private function dateDMY($value){
		$value = str_replace('/', '-', $value);
		return date("Y-m-d", strtotime($value));
	}

	private function currencyFormat($value){
		$value = str_replace('R$', '', $value);
		$value = str_replace(' ', '', $value);
		$value = str_replace('.', '', $value);
		$value = str_replace(',', '.', $value);
		return $value;
	}

	private function nullToOne($value){
		return 1;
	}

	private function nullToZero($value){
		return 0;
	}


	private function coordinateCellFailed($row, $row_index, $validator, $field){
		$x = $row_index;
		$y = array_search($field, array_keys($row));
		return [$x, $y];
	}


	public function isValid(){
		return (count($this->fails)==0);
	}

	public function fails(){
		return $this->fails;
	}

	public function changes(){
		return $this->changes;
	}

	public function validated(){
		return $this->validated;
	}

	public function cells(){
		//dd($this->cells);
		return $this->cells;
	}


	public static function beforeImport(BeforeImport $event)
	{
		$rows = $event->getDelegate()->getDelegate()->getActiveSheet()->getHighestRow()-1;
		$cells = $event->getDelegate()->getActiveSheet()->toArray();

		$import = $event->getConcernable();
		$import->initImport($rows, $cells);
	}

	public function initImport($rows, $cells){
		$this->progress = new ValidationProgressService($this->id, $rows);
		$this->fails = [];
		$this->changes = [];
		$this->header_not_present = [];
		$this->validated_rows = [];
		


		$this->cells = $cells;
		$this->columns = $this->parseColumns($this->cells);

	}

	private function parseColumns($cells){
		$columns = [];

		$header = [];
		foreach ($cells[0] as $column_name) {
			array_push($header, Str::slug($column_name, '_'));
		}

		array_shift($cells);

		foreach ($header as $column) {
			$columns[$column] = [];
		}


		foreach ($cells as $row) {
			foreach ($header as $index => $column) {
				array_push($columns[$column], $row[$index]);
			}
		}

		return $columns;
	}


	public function checkHeadings($path){
		$headings = (new HeadingRowImport)->toArray($path, 'local', Excel::XLSX)[0][0];
		foreach ($this->required as $heading) {
			if (!in_array($heading, $headings, true)) {
				return false;
			}
		}
		return true;
	}

	public function missing_headings($path){
		$missing_headings = [];
		$headings = (new HeadingRowImport)->toArray($path, 'local', Excel::XLSX)[0][0];
		foreach ($this->required as $heading) {
			if (!in_array($heading, $headings, true)) {
				array_push($missing_headings, $heading);
			}
		}
		// check appends required
		

		return $missing_headings;
	}

	public function getHeadings($path){
		return  (new HeadingRowImport)->toArray($path, 'local', Excel::XLSX)[0][0];
	}


	protected function chunkColumn($column, $start, $end){
		if(isset($this->columns[$column])){
			$chunk_column = array_slice($this->columns[$column], $start, $end);
			foreach ($chunk_column as $i => $value) {
				$chunk_column[$i] = trim($value);
			}
			return $chunk_column;
		} else {
			return [];
		}

	}

	protected function getIndexHeader($alias){

	}

	protected function getAliasHeader($index){

	}

	public function validatedRows(){
		array_unshift($this->validated_rows, $this->cells[0]);
		return $this->validated_rows;
	}
 


}

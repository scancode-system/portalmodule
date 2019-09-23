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


abstract class ValidatorImport implements OnEachRow, WithHeadingRow, WithEvents, ValidatorInterface
{

	use Importable, RegistersEventListeners;
	
	private $id;
	protected $progress;
	protected $fails;
	protected $changes;
	private $header_not_present;
	protected $cells;
	protected $columns;
	protected $validated;
	private $row;
	private $row_index;

	protected $required;


	public function __construct($id){
		$this->id = $id;
		$this->validated = true;
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
				}
			}
		}
	}

	private function validation(){
		$validator = Validator::make($this->row, $this->rule($this->row));
		$validator->addCustomValues($this->columns);

		if ($validator->fails()) {
			//dd($this->row);
			//dd($validator->failed());
			$this->validated = false;
			$fields = array_keys($validator->failed());
			foreach ($fields as $field) {
				$coordinate = $this->coordinateCellFailed($this->row, $this->row_index, $validator, $field);
				array_push($this->fails, [$coordinate[0], $coordinate[1]]);
			}
		}
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
						}
					}
				}
			}
		}
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


	public function filterRules(){
		return [];
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
		
		$this->cells = $cells;
		$this->columns = $this->parseColumns($this->cells);
	}

	private function parseColumns($cells){
		$columns = [];

		$header = [];
		foreach ($cells[0] as $column_name) {
			array_push($header, str_slug($column_name, '_'));
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
		return $missing_headings;
	}

}

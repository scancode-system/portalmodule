<?php

namespace Modules\Portal\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
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


	public function __construct($id){
		$this->id = $id;
		$this->validated = true;
	}


	public function onRow(Row $rowExcel)
	{
		$row = $this->filter($rowExcel);
		$row_index = $rowExcel->getRowIndex();

		$this->validation($row, $row_index, $this->columns);
		$this->progress->update();

	}

	private function validation($row, $row_index, $dataCustomValues){
		$validator = Validator::make($row, $this->rule($row));
		$validator->addCustomValues($dataCustomValues);

		if ($validator->fails()) {
			$this->validated = false;
			$fields = array_keys($validator->failed());
			foreach ($fields as $field) {
				$coordinate = $this->coordinateCellFailed($row, $row_index, $validator, $field);
				array_push($this->fails, [$coordinate[0], $coordinate[1]]);
			}
		}
	}


	private function filter($rowExcel){
		$row = $rowExcel->toArray();
		$header = array_keys($row);
		$filterRules = $this->filterRules();
		foreach ($filterRules as $filterRule) {
			$rule = $filterRule['rule'];
			$field = key($filterRule['rule']);
			$filter = $filterRule['filter'];

			$validator = Validator::make($row, $rule);
			if (!$validator->fails()) {
				$x = ($rowExcel->getRowIndex()-1);
				$y = array_search($field, $header);
				if($y || $y == 0){
					$value = $this->$filter($row[$field]);
					$this->cells[$x][$y] = $value;
					$row[$field] = $value;
					array_push($this->changes, [($x+1), $y]);
				}
			}
		}
		return $row;
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
		$header = $cells[0];
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

}

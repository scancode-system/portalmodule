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
	private $header_not_present;

	protected $cells;
	protected $columns;

	public function __construct($id){
		$this->id = $id;
	}


	public function onRow(Row $rowImported)
	{
		$row = $rowImported->toArray();
		$row_index = $rowImported->getRowIndex();

		$validator = Validator::make($row, $this->rule($row));
		$validator->addCustomValues($this->columns);

		if ($validator->fails()) {

			//dd($validator->failed());

			$fields = array_keys($validator->failed());
			foreach ($fields as $field) {
				$coordinate = $this->coordinateCellFailed($row, $row_index, $validator, $field);
				array_push($this->fails, [$coordinate[0], $coordinate[1]]);
			}
		}


		$this->progress->update();
	}


	private function coordinateCellFailed($row, $row_index, $validator, $field){
		$x = null;
		$y = null;
		$header = array_keys($row);

		$x = $row_index;
		$y = array_search($field, $header);

		if($y === false){
			$index_header_not_present = array_search($field, $this->header_not_present);
			if($index_header_not_present === false){
				$y = count($header)+count($this->header_not_present);
				array_push($this->header_not_present, $field);
			} else {
				$y = count($header)+$index_header_not_present;
			}
		}

		return [$x, $y];
	}


	public function isValid(){
		return (count($this->fails)==0);
	}

	public function fails(){
		return $this->fails;
	}

	public function cells(){
		$cells = $this->cells;
		$cells[0] = array_merge($cells[0], $this->header_not_present);
		return $cells;
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

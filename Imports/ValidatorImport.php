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
use Modules\Portal\Imports\ValidatorRowImport;
use Illuminate\Support\Str;
use Modules\Portal\Services\Validation\Data\InfoValidationsService;
use Modules\Portal\Services\Validation\ValidatorRowService;


class ValidatorImport implements OnEachRow, WithHeadingRow, WithEvents
{

	use Importable, RegistersEventListeners;
	
	private $info_validation;

	private $event_validation;
	protected $progress;

	protected $fails;
	protected $changes;
	
	protected $cells;
	protected $columns;
	
	protected $validated_rows;


	public function __construct(EventValidation $event_validation, InfoValidationsService $info_validations = null){ // put null because in code have intance to call only miss heading
		$this->event_validation = $event_validation;
		$this->info_validations = $info_validations;
	}


	public function onRow(Row $row)
	{
		$validator = new ValidatorRowService($this->event_validation, $this->info_validations, $this->columns, $row); //self::getValidatorRowService($this->event_validation, $this->columns, $row, $this->info_validations);
		$validator->run();

		$this->fails = $this->fails->merge($validator->fails());
		$this->changes = $this->changes->merge($validator->changes());
		$this->validated_rows = $this->validated_rows->merge($validator->validRowOrEmpty());
		$this->updateRow($validator->row(), $validator->index());
		$this->progress->update();
	}

	private function updateRow($row, $x)
	{
		$y = 0;
		foreach ($row as $value) {
			$this->cells[$x-1][$y] = $value;
			$y++;
		}
	}

 	private static function getValidatorRowService($event_validation, $columns, $row, $info_validations) // change that
	{
		$class = 'Modules\\'.$event_validation->validation->module_name.'\Services\ValidatorRow'.str_replace('_', '', ucwords($event_validation->validation->validation, '_')).'Service';
		return new $class($event_validation, $info_validations, $columns, $row);
	}

	public function fails(){
		return $this->fails->toArray();
	}

	public function changes(){
		return $this->changes->toArray();
	}

	public function cells(){
		return $this->cells;
	}

	public function getHeadings($path){
		return  (new HeadingRowImport)->toArray($path, 'local', Excel::XLSX)[0][0];
	}


	public function validatedRows(){
		$validated_rows = $this->validated_rows->toArray();
		array_unshift($validated_rows, $this->cells[0]);
		return $validated_rows;
	}


	/* START - events */
	public static function beforeImport(BeforeImport $event)
	{
		$rows = $event->getDelegate()->getDelegate()->getActiveSheet()->getHighestRow()-1;
		$cells = $event->getDelegate()->getActiveSheet()->toArray();

		$import = $event->getConcernable();
		$import->initImport($rows, $cells);
	}

	public function initImport($rows, $cells){
		$this->progress = new ValidationProgressService($this->event_validation->id, $rows);
		$this->fails = collect([]);
		$this->changes = collect([]);
		$this->validated_rows = collect([]);
		


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
	/* END - events */

}

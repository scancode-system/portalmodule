<?php

namespace Modules\Portal\Imports;

use \PhpOffice\PhpSpreadsheet\Shared\Date;
use \Exception;

class ValidatorRowImport
{

	private $header;
	private $index;
	private $row;


	public function __construct($row) 
	{
		$this->row = $row->toArray();
		$this->index = $row->getRowIndex();
		$this->header = array_keys($this->row);
	}

	public function run()
	{
		$this->before();

		dd($this->row);
		$this->validation();
		$this->after();
	}

	/* START - before */
	private function before()
	{
		$this->cast();
	}

	private function cast()
	{
		foreach ($this->row as $field => $value) {
			$this->castDate($field, $value);
			$this->castString($field, $value);
		}
	}

	private function castDate($field, $value){
		if(in_array($field, $array, true)){
			try {
				$this->row[$field] = Date::excelToDateTimeObject($value);
			} catch (Exception $e) {
				// Do Nothing
			}
		}
	}

	private function castString($field, $value)
	{
		
	}
	/* END - before */

	private function validation()
	{
		
	}

	/* START - after */
	private function after()
	{
		
	}
	/* END - after */

}

<?php

namespace Modules\Portal\Services\Validation;

use Modules\Portal\Entities\EventValidation;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Validator;
use \Exception;
use Modules\Portal\Services\Validation\Data\InfoValidationsService;

class ValidatorRowService
{

	private $event_validation;
	private $info_validations;
	protected $columns;

	protected $index;
	private $row;
	private $header;

	private $changes;
	private $fails;

	public function __construct(EventValidation $event_validation, InfoValidationsService $info_validations, $columns, $row) 
	{
		$this->event_validation = $event_validation;
		$this->info_validations = $info_validations;
		$this->columns = $columns;

		$this->index = $row->getRowIndex();
		$this->row = $row->toArray();
		$this->header = array_keys($this->row);
		
		$this->changes = collect([]);
		$this->fails = collect([]);
	}

	public function run()
	{
		$this->before();
		$this->validation();
	}

	/* START - before */
	private function before()
	{
		$this->cast();
		$this->modifiers();
	}

	private function cast()
	{
		foreach ($this->row as $field => $value) {
			$this->castDate($field, $value);
			$this->castString($field, $value);
		}
	}

	private function castDate($field, $value){
		//dd($this->header);
		//$this->appendDateColumns();
		if(in_array($field, $this->info_validations->columnsFormat(InfoValidationsService::DATE_FORMAT, $this->header), true)){
			try {
				$this->row[$field] = Date::excelToDateTimeObject($value);
			} catch (Exception $e) {
				// Do Nothing
			}
		}
	}

	private function castString($field, $value)
	{
		//$this->appendStringColumns();
		if(in_array($field, $this->info_validations->columnsFormat(InfoValidationsService::STRING_FORMAT, $this->header), true)){
			try {
				$this->row[$field] = strval($value);
			} catch (Exception $e) {
				// Do Nothing
			}
		}
		if(is_string($this->row[$field])){
			$this->row[$field] = trim($this->row[$field]);
		}
	}

	private function modifiers()
	{
		//$header = array_keys($this->row);
		//$filterRules = $this->filterRules();
		foreach ($this->info_validations->modifiers($this->row) as $filterRule) {
			$rule = $filterRule['rule'];
			$field = key($filterRule['rule']);
			$modifyMethod = $filterRule['filter'];

			//if(isset($this->row[$field])){

			$validator = Validator::make($this->row, $rule);
				//dd($rule);
			if (!$validator->fails()) {
				$x = self::getX($this->index);
				$y = self::getY($field, $this->header);

					//if($y || $y == 0){
				$old_value = $this->row[$field];
				$new_value = $this->$modifyMethod($this->row[$field]);
					//$this->cells[$x][$y] = $new_value; // vou passar as modificações na outra classe
				$this->row[$field] = $new_value;
				if($new_value !== $old_value){
					$this->changes->push([$x, $y]);
						//array_push($this->changes, [($x), $y]);  // aqui
					session(['validation.'.$this->event_validation->id.'.modified' => (session('validation.'.$this->event_validation->id.'.modified')+1) ]);
				}
					//}
			}
			//}
		}
	}

	private function setToZero($value){
		return 0;
	}

	private function setToOne($value){
		return 1;
	}

	private function setToHundred($value){
		return 100;
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

	private function removeAlphaCharacter($value){
		return preg_replace('/[^0-9]/', '', $value);
	}
	/* END - before */

	private function validation()
	{
		$validator = Validator::make($this->row, $this->info_validations->rule($this->row, $this->index, $this->columns));
		$validator->addCustomValues($this->columns);

		if ($validator->fails()) {
			$this->setFailed($validator);
		} else {
			$this->setSucess();
		}
	}

	private function setFailed($validator) // refatorar codigo
	{
		$fields = array_keys($validator->failed());
		foreach ($fields as $field) {
			$x = self::getX($this->index);
			$y = self::getY($field, $this->header);

			$this->fails->push([$x, $y, $validator->messages()->get($field)[0]]);
		}
		session(['validation.'.$this->event_validation->id.'.failures' => (1+session('validation.'.$this->event_validation->id.'.failures')) ]);
		$this->checkDuplicates($validator);
	}

	private function checkDuplicates($validator){
		$messages = $validator->messages()->all();
		foreach ($messages as $message) {
			if($message == 'Duplicado'){
				session(['validation.'.$this->event_validation->id.'.duplicates' => (1+session('validation.'.$this->event_validation->id.'.duplicates')) ]);
			}
		}
	}

	private function setSucess()
	{
		session(['validation.'.$this->event_validation->id.'.validated' => (1+session('validation.'.$this->event_validation->id.'.validated')) ]);
	}


	public function changes()
	{
		return $this->changes;
	}

	public function fails()
	{
		return $this->fails;
	}

	public function validRowOrEmpty()
	{
		return ($this->fails->count() == 0)? [array_values($this->row)]: [];
	}

	public function index()
	{
		return $this->index;
	}

	public function row()
	{
		return $this->row;
	}

	/* START - appends */
	
	/*public function rule($data){
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

	private function appendDateColumns(){
		foreach ($this->appendValidationsAll() as $append_validation) {
			$this->date_columns = array_merge($this->date_columns, $append_validation->date_columns);
		}
	}

	private function appendStringColumns(){
		foreach ($this->appendValidationsAll() as $append_validation) {
			$this->string_columns = array_merge($this->string_columns, $append_validation->string_columns);
		}
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
	}*/
	/* END - appends */



	/* START - helper static methods */
	private static function getX($index)
	{
		return $index;
	}

	private static function getY($field, $header)
	{
		return array_search($field, $header);
	}
	/* END - helper static methods */
}

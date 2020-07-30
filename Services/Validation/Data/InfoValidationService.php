<?php

namespace Modules\Portal\Services\Validation\Data;

abstract class InfoValidationService {

	abstract public function rule($data, $index, $columns);
	abstract public function modifiers();
	abstract public function columnsFormat();


	public static function chunkColumn($columns, $column, $start, $end)
	{
		//if(isset($columns[$column])){
		$chunk_column = array_slice($columns[$column], $start, $end);
		foreach ($chunk_column as $i => $value) {
			$chunk_column[$i] = trim($value);
		}
		return $chunk_column;
		/*} else {
			return [];
		}*/

	}

}
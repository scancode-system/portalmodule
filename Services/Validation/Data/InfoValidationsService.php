<?php

namespace Modules\Portal\Services\Validation\Data;

use Modules\Portal\Entities\EventValidation;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InfoValidationsService {

	const STRING_FORMAT = 'string';
	const DATE_FORMAT = 'date';

	private $event_validation;
	private $items;

	public function __construct(EventValidation $event_validation)
	{
		$this->event_validation = $event_validation;
		$this->loadItems();
	}

	private function loadItems()
	{
		$this->items = collect([]);

		$this->items->push(self::loadClass($this->event_validation->validation->module_name));
		foreach ($this->event_validation->event_validaton_appends as $event_validaton_append) {
			$this->items->push(self::loadClass($event_validaton_append->appendModel->module));
		}
	}

	public function rule($data, $index, $columns)
	{
		return $this->items->reduce(function ($carry, $item) use($data, $index, $columns) {
			return $carry->merge($item->rule($data, $index, $columns));
		}, collect([]))->toArray();
	}

	public function modifiers($row)
	{
		return $this->items->reduce(function ($carry, $item) use($row) {
			return $carry->merge($item->modifiers($row));
		}, collect([]));
	}

	public function columnsFormat($format, $header)
	{
		return $this->mergeColumnsFormat($header)->filter(function ($value, $key) use($format) {
			return $format == $value;
		})->keys()->toArray();
	}

	public function columnsFormatExcel($header)
	{
		return $this->mergeColumnsFormat($header)->map(function ($item, $key) {
			switch ($item) {
				case self::DATE_FORMAT : return NumberFormat::FORMAT_DATE_DDMMYYYY;
				break;
				case self::STRING_FORMAT :return '';
				break;
				default: return '';
				break;

			}
		});
	} 

	private function mergeColumnsFormat($header)
	{
		return $this->items->reduce(function ($carry, $item) use($header) {
			return $carry->merge($item->columnsFormat($header));
		}, collect([]));
	} 


	/* START - helper static methods */
	private static function loadClass($module)
	{
		$class = 'Modules\\'.$module.'\Services\InfoService';
		return new $class();
	}
	/* END - helper static methods */
}
<?php

namespace Modules\Portal\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

use Modules\Portal\Services\Validation\Data\InfoValidationsService;

use PhpOffice\PhpSpreadsheet\Cell\Cell;

use \Exception;
use \DateTime;

class ValidationExport implements FromArray, WithEvents, WithStrictNullComparison, ShouldAutoSize, WithColumnFormatting, WithMapping
{

	use Exportable;

	const  COLUMNS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

	protected $header;
	protected $cells;
	protected $changes;
	protected $fails;

	private $info_validation;

	public function __construct($cells, $changes, $fails, InfoValidationsService $info_validations)
	{
		$this->cells = $cells;
		$this->header = $cells[0];
		$this->changes = $changes;
		$this->fails = $fails;

		$this->info_validations = $info_validations;
	}


	public function array(): array
	{
		return $this->cells;
	}


	public function map($row): array
	{
		foreach ($row as $y => $value) {
			$row = $this->castDateToExcel($row, $y, $value);
		}
		return $row;
	}

	private function castDateToExcel($row, $y, $value){
		//if(in_array($this->header[$y], $this->date_columns, true)){
		if($value instanceof DateTime){
			$row[$y] = Date::dateTimeToExcel($value);
		}
		//}
		return $row;
	}

	public function columnFormats(): array
	{	
		//dd($this->info_validations->columnsFormatExcel());
		$format_columns = $this->info_validations->columnsFormatExcel($this->header)->mapWithKeys(function ($item, $key) {
			return [self::getColumnExcel($key, $this->header) => $item];
		});
		return $format_columns->toArray();
	}

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$sheet = $event->sheet;

				foreach ($this->changes as $change) {
					$this->changesBackground($change, $sheet);
				}

				foreach ($this->fails as $fail) {
					$this->failsBackground($fail, $sheet);
				}

			},
		];
	}

	private function changesBackground($change, $sheet){
		$cell= $sheet->getCellByColumnAndRow(($change[1]+1) , $change[0]);

		$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');

		$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');

		$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0063c2de');
	}

	private function failsBackground($fail, $sheet){
		$cell= $sheet->getCellByColumnAndRow(($fail[1]+1) , $fail[0]);

		$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');

		$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');

		$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00f86c6b');
	}


	/* START - helper static methods */
	private static function getColumnExcel($field, $header)
	{
		return self::COLUMNS[array_search($field, $header)];
	}
	/* END - helper static methods */

}

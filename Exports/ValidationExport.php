<?php

namespace Modules\Portal\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class ValidationExport extends DefaultValueBinder implements FromArray, WithEvents, WithStrictNullComparison, WithCustomValueBinder
{

	use Exportable;

	protected $cells;
	protected $changes;
	protected $fails;

	public function __construct($cells, $changes, $fails)
	{
		$this->cells = $cells;
		$this->changes = $changes;
		$this->fails = $fails;
	}


	public function array(): array
	{
		//dd($this->cells);
		return $this->cells;
	}

	public function bindValue(Cell $cell, $value)
	{
			$cell->setValueExplicit($value, DataType::TYPE_STRING);
			return true;
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

}

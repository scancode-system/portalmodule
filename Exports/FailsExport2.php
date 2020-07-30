<?php

namespace Modules\Portal\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
Use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class FailsExport implements FromArray, WithEvents, WithStrictNullComparison
{

	use Exportable;

	protected $cells;
	protected $fails;

	public function __construct($cells, $fails)
	{
		$this->cells = $cells;
		$this->fails = $fails;
	}


	public function array(): array
	{
		return $this->cells;
	}

	public function registerEvents(): array
	{
		return [
			AfterSheet::class    => function(AfterSheet $event) {
				$sheet = $event->sheet;

				foreach ($this->fails as $cell_failed) {
					$this->errorBackground($cell_failed, $sheet);
				}

			},
		];
	}

	private function errorBackground($cell_failed, $sheet){
		$cell= $sheet->getCellByColumnAndRow(($cell_failed[1]+1) , $cell_failed[0]);

		$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');

		$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');

		$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00f86c6b');
		
	}


}

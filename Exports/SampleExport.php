<?php

namespace Modules\Portal\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;


class SampleExport implements FromCollection, WithEvents
{

	use Exportable, RegistersEventListeners;

	private $data;
	private $filled_cells;

	public function __construct($data, $filled_cells) 
	{
		$this->data = $data;
		$this->filled_cells = $filled_cells;
	}

	public function collection()
	{
		return $this->data; 
	}

	public function getFiledCells()
	{
		return $this->filled_Cells;
	}

	public static function afterSheet(AfterSheet $event)
	{
		$sheet = $event->sheet;
		$filled_cells = $event->getConcernable()->filled_cells;
		foreach ($filled_cells as $filled_cell) 
		{
			$row = $filled_cell[0]+1;
			$column = $filled_cell[1]+1;

			$cell= $sheet->getCellByColumnAndRow($column , $row);
			$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00f86c6b');
			$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');
			$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');
		}
	}

}
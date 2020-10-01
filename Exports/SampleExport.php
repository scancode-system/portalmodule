<?php

namespace Modules\Portal\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SampleExport implements FromCollection, WithEvents, ShouldAutoSize
{

	use Exportable, RegistersEventListeners;

	const  COLUMNS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
	private $data;
	private $filled_cells;
	

	public function __construct($data, $filled_cells) 
	{
		$this->data = $data;
		$this->filled_cells = $filled_cells;
	}

	public function collection()
	{
		$cells = collect([]);
		$cells->push($this->data[0]);
		//$cells->push($this->data[1]);
		$cells->push($this->data[2]);
		return $cells;
	}

	public function getFiledCells()
	{
		return $this->filled_Cells;
	}

	public function getData()
	{
		return $this->data;
	}

	public static function afterSheet(AfterSheet $event)
	{
		$sample_export = $event->getConcernable(); 
		$filled_cells = $sample_export->filled_cells; 
		$sheet = $event->sheet;

		$data = $sample_export->getData(); 

		foreach ($filled_cells as $filled_cell) 
		{
			$row = $filled_cell[0]+1;
			$column = $filled_cell[1]+1;

			$cell= $sheet->getCellByColumnAndRow($column , $row);
			self::background($cell, 'f86c6b');
			self::color($cell, 'ffffff');

			$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00f86c6b');
			$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');
			$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');
		}

		for($i=1; $i<=count($sample_export->getData()[0]);$i++)
		{
			/*$cell= $sheet->getCellByColumnAndRow($i , 2);
			self::background($cell, 'ffc107');*/

			$cell= $sheet->getCellByColumnAndRow($i ,2);
			self::background($cell, '63c2de');

			$comment = $event->sheet->getDelegate()->getComment(self::COLUMNS[$i-1].'1');
			$comment->setMarginTop('100pt');
			$comment->setVisible(false);
			$comment->getText()->createTextRun($data[1][($i-1)]);
			
		}


	}

	private static function background($cell, $color){
		$cell->getStyle()->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00'.$color);
		$cell->getStyle()->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$cell->getStyle()->getBorders()->getOutline()->getColor()->setARGB('00808080');
	}

	private static function color($cell, $color){
		$cell->getStyle()->getFont()->getColor()->setARGB('ffffffff');
	}

}
<?php

namespace App\Exports;

use App\Oee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use DB;

class OeeExport implements FromCollection,WithHeadings,WithStyles,WithTitle,ShouldAutoSize, WithEvents
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Date',
            'OEE',
            'Availability',
            'Performance',
            'Quality',
            'RunTime',
            'AvailableTime',
            'ICT',
            'TotalParts',
            'GoodParts',
            'PartId',
            'LotId',
            'Shift'
        ];

    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:M1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function datos(int $idmaq,string $caso,string $date,int $group, string $casoS, string $partId,string $lotId,int $idShift,string $nomvar)
    {
        $this->date = $date;
        $this->group = $group;
        $this->idmaq = $idmaq;
        $this->nomvar = $nomvar;
        $this->caso = $caso;
        $this->casoS = $casoS;
        $this->partId = $partId;
        $this->lotId = $lotId;
        $this->idShift = $idShift;

        $this->title = $nomvar." ".$date;
        
        return $this;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function collection()
    {
        $DB_SP = env('DB_SP');
        $DB_SP_START= env('DB_SP_START');
        $DB_SP_END= env('DB_SP_END');

      return  collect(DB::select($DB_SP.' ConsultaOEETrendsGridExcel '.$DB_SP_START.'?,?,?,?,?,?,?,?'.$DB_SP_END,array($this->caso,$this->group,$this->idmaq,$this->date,$this->casoS,$this->partId,$this->lotId,$this->idShift)));
      
    }
}

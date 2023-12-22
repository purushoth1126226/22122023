<?php

namespace App\Export\Admin\Reports\Salereport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalereportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    private $salereport;

    public function __construct($salereport)
    {
        $this->salereport = $salereport;
    }

    public function collection()
    {
        return $this->salereport;
    }

    public function map($salereport): array
    {
        return [

            $salereport->id,
            $salereport->uniqid,
            $salereport->total_items,
            $salereport->total,
        ];
    }

    public function headings(): array
    {
        return [['SALES REPORT'], [], [
            'ID',
            'UNIQUE ID',
            'TOTAL ITEMS',
            'TOTAL',
        ],
        ];
    }

}

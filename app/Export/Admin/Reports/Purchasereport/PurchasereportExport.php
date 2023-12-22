<?php

namespace App\Export\Admin\Reports\Purchasereport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchasereportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    private $purchasereport;

    public function __construct($purchasereport)
    {
        $this->purchasereport = $purchasereport;
    }

    public function collection()
    {
        return $this->purchasereport;
    }

    public function map($purchasereport): array
    {
        return [

            $purchasereport->id,
            $purchasereport->uniqid,
            $purchasereport->supplier_id,
            $purchasereport->supplier_name,
            $purchasereport->total_items,
            $purchasereport->total,

        ];
    }

    public function headings(): array
    {
        return [['PURCHASE REPORT'], [], [
            'ID',
            'UNIQUE ID',
            'SUPPLIER ID',
            'SUPPLIER NAME',
            'TOTAL ITEMS',
            'TOTAL',
        ],
        ];
    }

}

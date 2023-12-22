<?php

namespace App\Export\Admin\Reports\Purchasereport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PurchaseitemreportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    private $purchaseitemreport;

    public function __construct($purchaseitemreport)
    {
        $this->purchaseitemreport = $purchaseitemreport;
    }

    public function collection()
    {
        return $this->purchaseitemreport;
    }

    public function map($purchaseitemreport): array
    {
        return [

            $purchaseitemreport->id,
            $purchaseitemreport->uniqid,
            $purchaseitemreport->product_name,
            $purchaseitemreport->price,
            $purchaseitemreport->quantity,
            $purchaseitemreport->total,

        ];
    }

    public function headings(): array
    {
        return [['PURCHASE ITEM REPORT'], [], [
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

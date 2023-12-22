<?php

namespace App\Export\Admin\Reports\Expensereport;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExpensereportExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    private $expense;

    public function __construct($expense)
    {
        $this->expense = $expense;
    }

    public function collection()
    {
        return $this->expense;
    }

    public function map($expense): array
    {
        return [

            $expense->uniqid,
            $expense->name,
            $expense->expensecategory->name ? $expense->expensecategory->name : '',
            $expense->amount,
        ];
    }

    public function headings(): array
    {
        return [['EXPENSE REPORTS'], [], [
            'UNIQUE ID',
            'NAME',
            'EXPENSE FOR',
            'AMOUNT',
        ],
        ];
    }

}

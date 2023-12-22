<?php

namespace App\Http\Controllers\Admin\Web\Sale;

use App\Http\Controllers\Controller;
use App\Models\Admin\Sale\Sale;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function sale(): view
    {
        return view('admin.sale.sale');
    }

    public function salecreateoredit($id = null): View
    {
        return view('admin.sale.salecreateoredit', compact('id'));
    }

    public function print($id): View
    {
        return view('admin.sale.print',
            [
                'sale' => Sale::with('saleitem')->find($id),
            ]);
    }
}

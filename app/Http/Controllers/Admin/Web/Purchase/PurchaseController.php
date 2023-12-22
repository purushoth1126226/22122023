<?php

namespace App\Http\Controllers\Admin\Web\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function purchase(): view
    {
        return view('admin.purchase.purchase');
    }

    public function purchasecreateoredit($id = null): View
    {
        return view('admin.purchase.purchasecreateoredit', compact('id'));
    }
}

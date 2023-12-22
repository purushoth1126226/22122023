<?php

namespace App\Http\Controllers\Admin\Web\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AdmindashboardController extends Controller
{
    public function dashboard(): view
    {
        return view('admin.dashboard.admindashboard');

    }

}

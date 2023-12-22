<?php

namespace App\Repository\Admin\Api\Businesslogic\Customer;

use App\Models\Admin\Customer\Customer;
use App\Repository\Admin\Api\Interfacelayer\Customer\IAdmincustomerApiRepository;

class AdmincustomerApiRepository implements IAdmincustomerApiRepository
{
    public function adminsearchcustomer()
    {
        return [true,
            Customer::query()
                ->where(fn($q) =>
                    $q->where('uniqid', 'like', '%' . request('search') . '%')
                        ->orWhere('name', 'like', '%' . request('search') . '%')
                        ->orWhere('phone', 'like', '%' . request('search') . '%')
                        ->orWhere('email', 'like', '%' . request('search') . '%'),
                )
                ->active()
                ->latest()
                ->limit(10)
                ->select('uuid', 'name', 'phone', 'email')
                ->get(),
            'Customer List'];
    }
}

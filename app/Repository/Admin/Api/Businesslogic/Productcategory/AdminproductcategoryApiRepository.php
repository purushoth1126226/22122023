<?php

namespace App\Repository\Admin\Api\Businesslogic\Productcategory;

use App\Models\Admin\Settings\Mastersettings\Productcategory;
use App\Repository\Admin\Api\Interfacelayer\Productcategory\IAdminproductcategoryApiRepository;

class AdminproductcategoryApiRepository implements IAdminproductcategoryApiRepository
{
    public function adminsearchproductcategory()
    {
        return [true,
            Productcategory::query()
                ->where(fn($q) =>
                    $q->where('uniqid', 'like', '%' . request('search') . '%')
                        ->orWhere('name', 'like', '%' . request('search') . '%'),
                )
                ->active()
                ->latest()
                ->limit(10)
                ->select('uuid', 'name', 'image')
                ->get(),
            'Product Category List'];

    }
}

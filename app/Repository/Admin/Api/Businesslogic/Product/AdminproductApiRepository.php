<?php

namespace App\Repository\Admin\Api\Businesslogic\Product;

use App\Models\Admin\Product\Product;
use App\Repository\Admin\Api\Interfacelayer\Product\IAdminproductApiRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AdminproductApiRepository implements IAdminproductApiRepository
{
    public function adminsearchproduct()
    {
        return [true,
            Product::query()
                ->where(fn($q) =>
                    $q->where('uniqid', 'like', '%' . request('search') . '%')
                        ->orWhere('name', 'like', '%' . request('search') . '%'),
                )
                ->when(request('productcategory_uuid'), fn($q1) =>
                    $q1->whereHas('productcategory', fn(Builder $q) => $q->where('uuid', request('productcategory_uuid'))))
                ->active()
                ->select('uuid', 'name', 'sellingprice', 'image')
                ->latest()
                ->limit(10)
                ->get(),
            'Product List'];
    }

    public function adminoverallproductsearch()
    {
        return [true,
            $product = Product::query()
                ->where(fn($query) =>
                    $query->where('name', 'like', '%' . request('search') . '%')
                        ->orWhereHas('category', fn($q) => $q->where('name', 'like', '%' . request('search') . '%'))
                )->active()
                ->latest()
                ->limit(10)
                ->select('uuid', 'name', 'sellingprice', 'image', 'stock', 'uniqid')
                ->get(),
            'Overall Product List'];
    }
}

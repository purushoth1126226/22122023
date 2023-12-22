<?php

namespace App\Repository\Admin\Api\Businesslogic\Order;

use App\Http\Resources\Order\Individualhistory\IndividualhistoryCollection;
use App\Http\Resources\Order\Overallhistory\OverallhistoryResource;
use App\Models\Admin\Sale\Sale;
use App\Repository\Admin\Api\Interfacelayer\Order\IOrderhistoryApiRepository;

class OrderhistoryApiRepository implements IOrderhistoryApiRepository
{
    public function individualhistory()
    {

        return [true,
            new IndividualhistoryCollection(Sale::where(fn($q) =>
                $q->where('uniqid', 'like', '%' . request('search') . '%')
                    ->orWhereHas('customer', fn($q) => $q->where('name', 'like', '%' . request('search') . '%'))
                    ->orWhereHas('customer', fn($q) => $q->where('phone', 'like', '%' . request('search') . '%'))
            )
                    ->paginate(10)),
            'Oral Pre-Screening List'];
    }

    public function overallhistory()
    {
        return [true,
            OverallhistoryResource::collection(Sale::where('uuid', request('uuid'))->get()),
            'Oral Pre-Screening Show By ID'];
    }

}

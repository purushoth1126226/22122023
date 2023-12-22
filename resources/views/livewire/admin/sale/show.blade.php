<div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2">
                    <h5 class="modal-title" id="showModalLabel"> {{ __('SHOW SALE') }} :
                        {{ $showdata->uniqid }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body bg-white">
                    <div class="row">
                        @include('helper.formhelper.showlabel', [
                            'name' => 'UNIQID',
                            'value' => $showdata->uniqid,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @if ($showdata->customer_id)
                            @include('helper.formhelper.showlabel', [
                                'name' => 'CUSTOMER NAME',
                                'value' => $showdata->customer->name,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'CUSTOMER PHONE',
                                'value' => $showdata->customer->phone,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'CUSTOMER EMAIL',
                                'value' => $showdata->customer->email,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                        @endif
                        @include('helper.formhelper.showlabel', [
                            'name' => 'TOTAL ITEMS',
                            'value' => $showdata->total_items,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'PAYMENT MODE',
                            'value' => $showdata->mode ? config('archive.mode')[$showdata->mode] : '',
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'NOTE',
                            'value' => $showdata->note,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED BY',
                            'value' => $showdata->createdby?->name,
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @include('helper.formhelper.showlabel', [
                            'name' => 'CREATED AT',
                            'value' => $showdata->created_at->format('d-M-Y h:i'),
                            'columnone' => 'col-md-6',
                            'columntwo' => 'col-5',
                            'columnthree' => 'col-7',
                        ])
                        @if ($showdata->updated_id)
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED BY',
                                'value' => $showdata->updatedby?->name,
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                            @include('helper.formhelper.showlabel', [
                                'name' => 'UPDATED AT',
                                'value' => $showdata->updated_at->format('d-M-Y h:i'),
                                'columnone' => 'col-md-6',
                                'columntwo' => 'col-5',
                                'columnthree' => 'col-7',
                            ])
                        @endif

                        <div class="container my-3">
                            <table class="table w-100 text-start table-borderless">
                                <thead>
                                    <tr class="table-teal">
                                        <th>
                                            Id
                                        </th>
                                        <th colspan="2">
                                            Product Name
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        <th>
                                            Price
                                        </th>
                                        <th class=" text-end">
                                            Total
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($showdata->saleitem as $eachsaleitem)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td colspan="2">
                                                {{ $eachsaleitem['product_name'] }}
                                            </td>
                                            <td>
                                                {{ $eachsaleitem['quantity'] }}
                                            </td>
                                            <td>
                                                {{ number_format($eachsaleitem['price'], 2) }}
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($eachsaleitem['total'], 2) }}
                                            </td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            SUB TOTAL:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->sub_total, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            EXTRA CHARGES:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->extra_charges, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            DISCOUNT:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->discount, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            TOTAL:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->total, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            ROUND OFF:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->roundoff, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            AMOUNT RECIEVED:
                                        </td>
                                        <td>
                                            {{ number_format($showdata->received_amount, 2) }}
                                        </td>
                                        <td>
                                            AMOUNT REPAY:
                                        </td>
                                        <td>
                                            {{ number_format($showdata->remaining_amount, 2) }}
                                        </td>
                                        <td>
                                            GRAND TOTAL:
                                        </td>
                                        <td class="text-end">
                                            {{ number_format($showdata->grandtotal, 2) }}
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light px-2 py-1">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </div>
        @endif
    </div>
</div>

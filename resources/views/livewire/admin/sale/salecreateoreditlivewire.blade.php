<div>

    <form wire:submit.prevent="storesale" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data"
        autocomplete="off">

        <div class="card ">

            {{-- Header --}}

            <div class="card-header text-white theme_bg_color px-3 py-2">
                <span class="h5">{{ isset($sale) ? 'UPDATE' : 'CREATE' }} SALE</span>
                <a class="btn btn-sm btn-secondary shadow float-end mx-1" href="{{ route('adminsale') }}"
                    role="button">Back</a>
            </div>

            {{-- Search Items --}}
            <div class="container">
                <div class="w-75 mx-auto">
                    <div class="d-flex">
                        <div class="col-md-11">
                            <input class="form-control mt-3 z-0" wire:model.live="product_selected" id="product_id"
                                wire:change="searchproduct" wire:keyup="searchproduct" type="text"
                                placeholder="Search Products..." wire:keyup.arrow-up="decrementHighlight"
                                wire:keydown.arrow-down="incrementHighlight" wire:keydown.enter="enterproduct"
                                wire:click="searchproductreset" autofocus>
                        </div>
                        <div class="col-md-1">
                            <div wire:loading class="spinner-border spinner-border-sm text-info mt-4 ms-4"
                                role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    @error('product')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @if (!empty($product_selected) && !empty($searchproductlist))
                        <ul class="list-group position-absolute w-75">
                            @if (!empty($searchproductlist))
                                @foreach ($searchproductlist as $i => $eachsearchproductlist)
                                    <li class="list-group-item  {{ $highlightIndex === $i ? 'theme_bg_color text-white' : '' }}"
                                        wire:click="onclickproduct('{{ $eachsearchproductlist->id }}')">
                                        <h6>
                                            <span class="badge bg-primary rounded-pill">
                                                {{ $eachsearchproductlist->sku }}
                                            </span>
                                            {{ $eachsearchproductlist->name }}

                                            <span class="badge bg-primary rounded-pill float-end">
                                                {{ $eachsearchproductlist->stock }}
                                            </span>
                                        </h6>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Form --}}
            <div class="card-body">
                <table class="table w-100 text-start table-borderless">
                    <thead>
                        <tr class="table-teal">
                            <th width="10%">
                                S.NO
                            </th>
                            <th width="40%">
                                NAME
                            </th>
                            <th width="16%" class="text-center">
                                RATE
                            </th>
                            <th width="16%" class="text-center">
                                QUANTITY
                            </th>
                            <th width="16%" class="text-center">
                                TOTAL
                            </th>
                            <th width="2%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product as $key => $eachproductlist)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>

                                    <span> {{ $eachproductlist['product_name'] }} </span>

                                </td>
                                <td>
                                    <input class="form-control text-end shadow-sm" style="border: 0px;"
                                        wire:model="product.{{ $key }}.product_rate"
                                        wire:change="productcalculation('{{ $key }}')"
                                        wire:keyup="productcalculation('{{ $key }}')" type="number">
                                    @error('product.' . $key . '.product_rate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input class="form-control text-center shadow-sm" style="border: 0px;"
                                        wire:model="product.{{ $key }}.product_quantity"
                                        wire:change="productcalculation('{{ $key }}')"
                                        wire:keyup="productcalculation('{{ $key }}')" type="number">
                                    @error('product.' . $key . '.product_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="text-end">
                                    <div class="form-control text-end shadow-sm" style="border: 0px;">
                                        {{ number_format($eachproductlist['product_subtotal'], 2) }}
                                    </div>
                                    {{-- <span class="me-3" style="border: 0px;">
                                        {{ number_format($eachproductlist['product_subtotal'], 2) }} </span> --}}
                                </td>
                                <td>
                                    <svg class="text-danger" role='button'
                                        wire:click.prevent="removeitem({{ $key }})"
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Sub Total
                            </td>
                            <td class="text-end">
                                <div class="form-control shadow-sm" style="border: 0px;">
                                    ₹{{ number_format($form['sub_total'], 2) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td width="14%">
                                Extra Charges
                            </td>
                            <td class="text-end">
                                <input class="form-control text-end shadow-sm" style="border: 0px;"
                                    wire:model.live="form.extra_charges" wire:change="overallcalc()"
                                    wire:keyup="overallcalc()" type="number" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Discount
                            </td>
                            <td>
                                <input class="form-control text-end shadow-sm" style="border: 0px;"
                                    wire:model.live="form.discount" wire:change="overallcalc()"
                                    wire:keyup="overallcalc()" type="number" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Total
                            </td>
                            <td>
                                <div class="form-control text-end shadow-sm" style="border: 0px;">
                                    ₹{{ number_format($form['total'], 2) }}
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Round Off
                            </td>
                            <td>
                                <div class="form-control text-end shadow-sm" style="border: 0px;">
                                    ₹{{ number_format($form['roundoff'], 2) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="received_amount" class="form-label">Cash Received </label>
                                    </div>
                                    <div class="col-auto">
                                        <input class="form-control text-end shadow-sm" style="border: 0px;"
                                            wire:model.live="form.received_amount" wire:change="overallcalc()"
                                            wire:keyup="overallcalc()" type="number" />
                                        @error('form.received_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="remaining_amount" class="form-label">Amount Repay</label>
                                    </div>
                                    <div class="col-auto">
                                        <input class="form-control text-end shadow-sm" style="border: 0px;"
                                            wire:model.live="form.remaining_amount" wire:change="overallcalc()"
                                            wire:keyup="overallcalc()" type="number" readonly />
                                    </div>
                                </div>

                            </td>
                            <td>
                                Grand Total
                            </td>
                            <td>
                                <input class="form-control text-end shadow-sm" style="border: 0px;"
                                    wire:model.live="form.grandtotal" wire:change="overallcalc()"
                                    wire:keyup="overallcalc()" type="number" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- Customer --}}

            <div class="container">
                <div class="row g-3">
                    <div class="col-3 position-relative ">
                        <label class="form-label" for="customerphone">CUSTOMER PHONE</label>


                        <input class="form-control" wire:model.live="customerphone" id="customerphone"
                            type="number" wire:keyup.arrow-up="customerdecrement"
                            wire:keydown.arrow-down="customerincrement" wire:keydown.enter="entercustomer">
                        @error('form.customer_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror



                        @if (!empty($customerphone) && !empty($searchcustomerlist))
                            <ul class="list-group position-absolute w-100 ">
                                @if (!empty($searchcustomerlist))
                                    @foreach ($searchcustomerlist as $skey => $eachsearchcustomerlist)
                                        <li style="cursor: pointer;"
                                            class="list-group-item d-lg-flex justify-content-between align-items-start w-100 {{ $customerhighlightIndex === $skey ? 'theme_bg_color text-white' : '' }}"
                                            wire:click="clickcustomer('{{ $eachsearchcustomerlist->id }}')">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">{{ $eachsearchcustomerlist->name }}</div>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">Phone :
                                                {{ $eachsearchcustomerlist['phone'] }}</span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        @endif

                    </div>

                    <div class="col-3">
                        <label for="customer_name" class="form-label">CUSTOMER NAME</label>
                        <input wire:model.live="form.customer_name" type="text" class="form-control"
                            id="customer_name" readonly>
                    </div>

                    <div class="col-3">
                        <label for="customer_email" class="form-label">CUSTOMER EMAIL</label>
                        <input wire:model.live="form.customer_email" type="text" class="form-control"
                            id="customer_email" readonly>
                    </div>

                    @include('helper.formhelper.form', [
                        'type' => 'textarea',
                        'fieldname' => 'form.note',
                        'labelname' => 'NOTE',
                        'labelidname' => 'noteid',
                        'required' => false,
                        'readonly' => false,
                        'col' => 'col-md-3',
                    ])
                </div>
            </div>

            {{-- Button --}}


            <div class="text-muted text-center m-2">
                <button wire:click.prevent="submit(1)" type="button" class="btn btn-success  rounded-3"
                    style="font-size:12px;">
                    CASH
                </button>
                <button wire:click.prevent="submit(2)" type="button" class="btn btn-success  rounded-3"
                    style="font-size:12px;">
                    CARD
                </button>
                <button wire:click.prevent="submit(3)" type="button" class="btn btn-success  rounded-3"
                    style="font-size:12px;">
                    ONLINE
                </button>
                <a href="{{ route('adminsale') }}" type="button" class="btn btn-secondary rounded-3"
                    style="font-size:12px;">CANCEL</a>
            </div>

        </div>

    </form>

</div>

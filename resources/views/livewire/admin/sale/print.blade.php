<div class="modal fade" id="printmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="printmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        @if ($showdata)
            <div class="modal-content">
                <div class="modal-header text-white theme_bg_color px-3 py-2" style="background-color :#37474f">
                    <h5 class="modal-title" id="printmodalLabel">Sale : {{ $showdata->uniqid }} </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container my-4">

                        <div>
                            <div class="text-center"><b>Simple Pos</b>
                            </div>
                            <div class="text-center">No: 38, Nehru Nagar,2nd Avenue, Anna Nagar West. Chennai 600040.
                                Land mark: Near Thirumangalam metro station.<br>
                                Ph : 0123456789, 0123456789
                            </div>
                            <div style="border-bottom: 1px solid black;"></div>
                            <div style="display:flex; justify-content:space-between;">
                                <div>Bill No: <b>{{ $showdata->uniqid }}</b></div>
                                <div> Total Items: <b>{{ $showdata->total_items }}</b></div>
                            </div>
                            <div style="display:flex; justify-content:space-between; margin-bottom:2px;">
                                <div>Date: <b>{{ $showdata->created_at->format('d/M/Y') }}</b></div>
                                <div>Time: <b>{{ $showdata->created_at->format('H:i:s') }}</b></div>
                            </div>
                            @if ($showdata->customer_id)
                                <div style="display:flex; justify-content:space-between; margin-bottom:2px;">
                                    <div>Name: <b>{{ $showdata->customer_name }}</b></div>
                                    <div>Phone: <b>{{ $showdata->customer_phone }}</b></div>
                                </div>
                            @endif
                            <div style="display:flex; justify-content:space-between; margin-bottom:2px;">
                                <div>Mode:
                                    <b>{{ $showdata->mode ? Config::get('archive.mode')[$showdata->mode] : null }}</b>
                                </div>
                            </div>
                            <div style="border-bottom: 1px solid black;"></div>
                            <table style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th
                                            style="width: 55%; padding:3px 0px; font-size: 14px; text-align:left;border-bottom: 1px solid black;">
                                            Item
                                            Name</th>
                                        <th
                                            style="width: 10%; padding:3px 0px; font-size: 14px; text-align:center;border-bottom: 1px solid black;">
                                            Qty
                                        </th>
                                        <th
                                            style="width: 15%; padding:3px 0px; font-size: 14px; text-align:center;border-bottom: 1px solid black;">
                                            Rate</th>
                                        <th
                                            style="width: 20%; padding:3px 0px; font-size: 14px; text-align:right;border-bottom: 1px solid black;">
                                            Amount</th>
                                    </tr>
                                </thead>
                                <tbody style="width: 100%;">
                                    @foreach ($showdata->saleitem as $eachsaleitem)
                                        <tr style="width: 100%;">
                                            <td style="width: 55%; font-size: 13px; text-align:left;">
                                                {{ $eachsaleitem->product_name }}
                                            </td>
                                            <td style="width: 10%; font-size: 13px; text-align:center;">
                                                {{ $eachsaleitem->quantity }}
                                            </td>
                                            <td style="width: 15%; font-size: 13px; text-align:center;">
                                                {{ $eachsaleitem->price }}
                                            </td>
                                            <td style="width: 20%; font-size: 13px; text-align:right;">
                                                {{ $eachsaleitem->total }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="border-bottom: 1px solid black;"></div>
                            <span>
                                <table style="width: 100%; border-collapse: collapse;">
                                    <tbody style="width: 100%;">
                                        @if ($showdata->discount || $showdata->extra_charges)
                                            <tr style="width: 100%; padding-top:1px;">
                                                <td
                                                    style="width: 50%; padding:0px 0px; font-size: 13px;text-align:left;">

                                                </td>
                                                <td
                                                    style="width: 40%; padding:0px 0px; font-size: 13px;text-align:left;">
                                                    <b>Sub Total :</b>
                                                </td>
                                                <td
                                                    style="width: 10%; padding:0px 0px; font-size: 13px;text-align:right;">
                                                    {{ number_format($showdata->sub_total, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($showdata->extra_charges)
                                            <tr style="width: 100%;">
                                                <td
                                                    style="width: 50%; padding:0px 0px; font-size: 13px;text-align:left;">

                                                </td>
                                                <td
                                                    style="width: 40%; padding:0px 0px; font-size: 13px;text-align:left;">
                                                    <b>Extra Charges :</b>
                                                </td>
                                                <td
                                                    style="width: 10%; padding:0px 0px; font-size: 13px;text-align:right;">
                                                    {{ number_format($showdata->extra_charges, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        @if ($showdata->discount)
                                            <tr style="width: 100%;">
                                                <td
                                                    style="width: 50%; padding:0px 0px; font-size: 13px;text-align:left;">

                                                </td>
                                                <td
                                                    style="width: 40%; padding:0px 0px; font-size: 13px;text-align:left;">
                                                    <b>Discount :</b>
                                                </td>
                                                <td
                                                    style="width: 10%; padding:0px 0px; font-size: 13px;text-align:right;">
                                                    {{ number_format($showdata->discount, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <table
                                    style="width: 100%; border-collapse: collapse; margin-bottom:4px; padding-bottom:2px;">
                                    <tbody style="width: 100%;">
                                        <tr style="width: 100%; border-top: 1px solid black; ">
                                            <td
                                                style="width: 50%; padding:0px 0px; font-size: 13px;text-align:left; margin-top:2px;">

                                            </td>
                                            <td
                                                style="width: 40%; padding:0px 0px; font-size: 13px;text-align:left; margin-top:2px;">
                                                <b>Total :</b>
                                            </td>
                                            <td
                                                style="width: 10%; padding:0px 0px; font-size: 13px;text-align:right; margin-top:2px;">
                                                {{ number_format($showdata->total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </span>
                            <span>
                                <div style="border-bottom: 1px solid black;"></div>
                                <div class="text-center py-2">Thank
                                    you! Visit Again
                                </div>
                            </span>
                        </div>

                        <div class="modal-footer bg-light px-2 py-1">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            <a href="{{ route('saleprint', ['id' => $showdata->id]) }}" type="button"
                                class="btn btn-success">Print</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

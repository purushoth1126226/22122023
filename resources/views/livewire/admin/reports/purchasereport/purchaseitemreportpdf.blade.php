<div>
    <div style="text-align:center;">
        <h3>Purchaseitem Report</h3>
    </div>
    <table style="border: 1px solid; border-collapse: collapse; width:100%; font-size:10px;">
        <thead>
            <tr>
                <th style="border: 1px solid;">SI.NO</th>
                <th style="border: 1px solid;">ID</th>
                <th style="border: 1px solid;">NAME</th>
                <th style="border: 1px solid;">PRICE</th>
                <th style="border: 1px solid;">TOTAL</th>
                <th style="border: 1px solid;">PURCHASE DATE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchaseitemreport as $key => $item)
                <tr>
                    <td style="border: 1px solid;">{{ $key + 1 }}</td>
                    <td style="border: 1px solid;">{{ $item->id }}</td>
                    <td style="border: 1px solid;">{{ $item->product_name }}</td>
                    <td style="border: 1px solid;">{{ $item->price }}</td>
                    <td style="border: 1px solid;">{{ $item->total }}</td>
                    <td style="border: 1px solid;">{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    <x-admin.layouts.admintableindex>

        <x-slot name="title">
            STOCK HISTORY
        </x-slot>

        <x-slot name="action">
            <a wire:navigate class="btn btn-sm btn-secondary shadow float-end mx-1"
                href="{{ route('adminstockadjustment') }}" role="button">Back</a>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'CREDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DEBIT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'BALANCE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'ADJUSTMENT',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'DATE',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($this->stockhistory as $index => $eachstockhistory)
                <tr class="{{ $eachstockhistory->c_or_d == 'C' ? 'table-success' : 'table-danger' }}">
                    <td class="text-center">{{ $this->stockhistory->firstItem() + $index }}</td>
                    <td class="text-center">{{ $eachstockhistory->credit }}</td>
                    <td class="text-center">{{ $eachstockhistory->debit }}</td>
                    <td class="text-center">{{ $eachstockhistory->balance }}</td>
                    <td class="text-center">{{ $eachstockhistory->is_adjustment }}</td>
                    <td class="text-center">{{ $eachstockhistory->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </x-slot>
        {{-- #d1e7dd --}}
        <x-slot name="tablerecordtotal">
            Showing {{ $this->stockhistory->firstItem() }} to {{ $this->stockhistory->lastItem() }} out of
            {{ $this->stockhistory->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $this->stockhistory->links() }}
        </x-slot>

    </x-admin.layouts.admintableindex>

</div>

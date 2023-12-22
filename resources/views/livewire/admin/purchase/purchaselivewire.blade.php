<div>
    <x-admin.layouts.admintableindex>

        <x-slot name="title">
            PURCHASE
        </x-slot>

        <x-slot name="action">
            <a href="{{ route('purchasecreateoredit') }}" type="button"
                class="btn btn-sm btn-primary shadow float-end mx-1">
                Create
            </a>
        </x-slot>

        <x-slot name="tableheader">
            @include('helper.tablehelper.tableheader', [
                'name' => 'S.NO',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'UNIQID',
                'type' => 'sortby',
                'sortname' => 'uniqid',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SUPPLIER NAME',
                'type' => 'sortby',
                'sortname' => 'supplier_name',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'SUPPLIER PHONE',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'TOTAL ITEMS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'GRAND TOTAL',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'VIEW/EDIT',
                'type' => 'normal',
                'sortname' => '',
            ])
        </x-slot>

        <x-slot name="tablebody">
            @foreach ($this->purchase as $index => $eachpurchase)
                <tr>
                    <td>{{ $this->purchase->firstItem() + $index }}</td>
                    <td>{{ $eachpurchase->uniqid }}</td>
                    <td class="text-center">{{ $eachpurchase->supplier_name }}</td>
                    <td class="text-start">{{ $eachpurchase->supplier_phone }}</td>
                    <td class="text-start">{{ $eachpurchase->total_items }}</td>
                    <td class="text-start">Rs.{{ $eachpurchase->grandtotal }}</td>
                    <td>
                        <button wire:click="show({{ $eachpurchase->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <a href="{{ route('purchasecreateoredit', ['id' => $eachpurchase->id]) }}"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $this->purchase->firstItem() }} to {{ $this->purchase->lastItem() }} out of
            {{ $this->purchase->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $this->purchase->links() }}
        </x-slot>

    </x-admin.layouts.admintableindex>


    <!-- Show Modal -->
    @include('livewire.admin.purchase.show')

    <!-- Modal Action Helper -->
    @include('livewire.helper.livewiremodalhelper')

</div>

<div>
    <x-admin.layouts.admintableindex>

        <x-slot name="title">
            SALE
        </x-slot>

        <x-slot name="action">
            <a href="{{ route('salecreateoredit') }}" type="button" class="btn btn-sm btn-primary shadow float-end mx-1">
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
                'name' => 'TOTAL ITEMS',
                'type' => 'normal',
                'sortname' => '',
            ])
            @include('helper.tablehelper.tableheader', [
                'name' => 'PAYMENT MODE',
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
            @foreach ($this->sale as $index => $eachsale)
                <tr>
                    <td>{{ $this->sale->firstItem() + $index }}</td>
                    <td>{{ $eachsale->uniqid }}</td>
                    <td class="text-center">{{ $eachsale->total_items }}</td>
                    <td class="text-center">{{ $eachsale->mode ? Config::get('archive.mode')[$eachsale->mode] : null }}
                    </td>
                    <td class="text-center">{{ $eachsale->grandtotal }}</td>
                    <td>
                        <button wire:click="show({{ $eachsale->id }})" class="btn btn-sm btn-success"><i
                                class="bi bi-eye-fill"></i></button>
                        <a href="{{ route('salecreateoredit', ['id' => $eachsale->id]) }}"
                            class="btn btn-sm btn-primary"><i class="bi bi-pencil-fill"></i></a>
                        <button wire:click="print({{ $eachsale->id }})" class="btn btn-sm btn-warning"><i
                                class="bi bi-printer"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot>

        <x-slot name="tablerecordtotal">
            Showing {{ $this->sale->firstItem() }} to {{ $this->sale->lastItem() }} out of
            {{ $this->sale->total() }}
            items
        </x-slot>

        <x-slot name="pagination">
            {{ $this->sale->links() }}
        </x-slot>

    </x-admin.layouts.admintableindex>


    <!-- Show Modal -->
    @include('livewire.admin.sale.show')

    <!--Print -->
    @include('livewire.admin.sale.print')


    <!-- Modal Action Helper -->
    @include('livewire.helper.livewiremodalhelper')
    <script type="text/javascript">
        document.addEventListener('livewire:init', () => {
            // window.livewire.on('printmodal', () => {
            //     var myModal = new bootstrap.Modal(document.getElementById('printmodal'))
            //     myModal.show();
            // });
            Livewire.on('printmodal', () => {
                var myModal = new bootstrap.Modal(document.getElementById('printmodal'))
                myModal.show();
            });
        });
    </script>


</div>
